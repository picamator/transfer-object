<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class BuildInTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string UNSUPPORTED_TYPE_ERROR_MESSAGE_TEMPLATE = 'Property "%s" with type "%s" is not supported.';

    /**
     * @var array<string,\Picamator\TransferObject\Generated\ValidatorMessageTransfer>
     */
    private static array $validatorCache;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->buildInType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        /** @var \Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum $buildInType */
        $buildInType = $propertyTransfer->buildInType;
        $cacheKey = $buildInType->value;

        if (isset(self::$validatorCache[$cacheKey])) {
            return self::$validatorCache[$cacheKey];
        }

        if ($buildInType->isAllowed()) {
            return self::$validatorCache[$cacheKey] = $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return self::$validatorCache[$cacheKey] = $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::UNSUPPORTED_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->buildInType->value ?? '',
        );
    }
}
