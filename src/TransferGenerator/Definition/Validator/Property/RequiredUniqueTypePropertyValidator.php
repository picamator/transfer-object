<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\DefinitionTypeKeyEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class RequiredUniqueTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string PROPERTY_REQUIRED_UNIQUE_ERROR_MESSAGE_TEMPLATE = 'Property "%s" type definition is not set or set twice.';

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
            self::PROPERTY_REQUIRED_UNIQUE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
