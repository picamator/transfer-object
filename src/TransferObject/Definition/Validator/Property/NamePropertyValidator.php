<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\VariableValidatorTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class NamePropertyValidator implements PropertyValidatorInterface
{
    use VariableValidatorTrait;

    private const string PROPERTY_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid property "%s" name.';

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $validatorTransfer = new ValidatorMessageTransfer();

        if ($this->isValidVariable($propertyTransfer->propertyName)) {
            $validatorTransfer->isValid = true;

            return $validatorTransfer;
        }

        $validatorTransfer->errorMessage = $this->getErrorMessage($propertyTransfer);
        $validatorTransfer->isValid = false;

        return $validatorTransfer;
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::PROPERTY_NAME_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
