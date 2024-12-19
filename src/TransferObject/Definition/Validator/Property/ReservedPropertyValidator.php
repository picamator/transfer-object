<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Enum\ReservedPropertyEnum;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorTransfer;

readonly class ReservedPropertyValidator implements PropertyValidatorInterface
{
    private const string PROPERTY_NAME_INVALID_ERROR_MESSAGE_TEMPLATE = 'Cannot use reserved "%s" property name.';

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();

        if (!ReservedPropertyEnum::tryFrom($propertyTransfer->propertyName)) {
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
            self::PROPERTY_NAME_INVALID_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
