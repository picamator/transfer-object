<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class TransferTypePropertyValidator implements PropertyValidatorInterface
{
    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->transferType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        return $this->classNameValidator->validate($propertyTransfer->transferType);
    }
}
