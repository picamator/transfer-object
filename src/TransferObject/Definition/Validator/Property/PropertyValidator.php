<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use ArrayObject;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class PropertyValidator implements PropertyValidatorInterface
{
    /**
     * @param \ArrayObject<\Picamator\TransferObject\Definition\Validator\Property\PropertyValidatorInterface> $propertyValidators
     */
    public function __construct(
        private ArrayObject $propertyValidators,
    ) {
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        foreach ($this->propertyValidators as $validator) {
            $validatorTransfer = $validator->validate($propertyTransfer);
            if ($validatorTransfer->isValid) {
                continue;
            }

            return $validatorTransfer;
        }

        return $this->createValidatorTransfer();
    }

    private function createValidatorTransfer(): ValidatorMessageTransfer
    {
        $validatorTransfer = new ValidatorMessageTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }
}
