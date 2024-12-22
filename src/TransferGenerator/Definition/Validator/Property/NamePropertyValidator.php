<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\VariableValidatorTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class NamePropertyValidator implements PropertyValidatorInterface
{
    use VariableValidatorTrait;
    use ValidatorMessageTrait;

    private const string PROPERTY_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid property "%s" name.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if ($this->isValidVariable($propertyTransfer->propertyName)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::PROPERTY_NAME_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
