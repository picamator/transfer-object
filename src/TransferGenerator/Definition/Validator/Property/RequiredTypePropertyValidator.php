<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\DefinitionTypeKeyEnum;

readonly class RequiredTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string MISSED_REQUIRED_TYPE_ERROR_MESSAGE_TEMPLATE
        = 'Property "%s" type definition is missing or set multiple times.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $definedTypes = [];
        foreach (DefinitionTypeKeyEnum::cases() as $definitionTypeKey) {
            $definedTypes[] = $propertyTransfer->{$definitionTypeKey->value};
        }

        $definedTypes = array_filter($definedTypes);
        if (count($definedTypes) === 1) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::MISSED_REQUIRED_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
