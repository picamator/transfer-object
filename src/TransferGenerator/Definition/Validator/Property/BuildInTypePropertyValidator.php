<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class BuildInTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string UNSUPPORTED_PROPERTY_TYPE_ERROR_MESSAGE_TEMPLATE = 'Property "%s" type "%s" is not supported.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->buildInType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if (BuildInTypeEnum::isAllowed($propertyTransfer->buildInType)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::UNSUPPORTED_PROPERTY_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->buildInType ?? '',
        );
    }
}
