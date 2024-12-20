<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class CollectionTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if ($propertyTransfer->collectionType === null) {
            return $this->createSuccessMessageTransfer();
        }

        return $this->classNameValidator->validate($propertyTransfer->collectionType);
    }
}
