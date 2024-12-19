<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorTransfer;

readonly class CollectionTypePropertyValidator implements PropertyValidatorInterface
{
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorTransfer
    {
        if ($propertyTransfer->collectionType === null) {
            return $this->createValidatorTransfer();
        }

        return $this->classNameValidator->validate($propertyTransfer->collectionType);
    }

    private function createValidatorTransfer(): ValidatorTransfer
    {
        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = true;

        return $validatorTransfer;
    }
}
