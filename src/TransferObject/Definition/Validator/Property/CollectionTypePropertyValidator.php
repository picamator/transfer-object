<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class CollectionTypePropertyValidator implements PropertyValidatorInterface
{
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if ($propertyTransfer->collectionType === null) {
            return $this->createValidatorTransfer();
        }

        return $this->classNameValidator->validate($propertyTransfer->collectionType);
    }

    private function createValidatorTransfer(): ValidatorMessageTransfer
    {
        $validatorTransfer = new ValidatorMessageTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }
}
