<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\TransferGenerator\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class CollectionTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->collectionType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        return $this->classNameValidator->validate($propertyTransfer->collectionType);
    }
}
