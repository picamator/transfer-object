<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class BuildInTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string UNSUPPORTED_TYPE_ERROR_MESSAGE_TEMPLATE = 'Property "%s" with type "%s" is not supported.';

    /**
     * @var array<string,true>
     */
    private static array $successCache;

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        $buildInType = $propertyTransfer->buildInType;

        return $buildInType !== null && !isset(self::$successCache[$buildInType->name->value]);
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        /** @var \Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer $buildInTypeTransfer */
        $buildInTypeTransfer = $propertyTransfer->buildInType;

        if ($buildInTypeTransfer->name->isAllowed()) {
            self::$successCache[$buildInTypeTransfer->name->value] = true;

            return null;
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::UNSUPPORTED_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->buildInType?->name->value ?? '',
        );
    }
}
