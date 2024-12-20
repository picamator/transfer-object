<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Enum\UnsupportedTypeEnum;
use Picamator\TransferObject\Definition\Enum\TypeEnum;
use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class TypePropertyValidator implements PropertyValidatorInterface
{
    private const string PROPERTY_TYPE_UNSUPPORTED_ERROR_MESSAGE_TEMPLATE = 'Property "%s" type "%s" is not supported.';

    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $validatorTransfer = new ValidatorMessageTransfer();
        if ($propertyTransfer->type === null) {
            $validatorTransfer->isValid = true;

            return $validatorTransfer;
        }

        if (UnsupportedTypeEnum::isUnsupported($propertyTransfer->type)) {
            $validatorTransfer->isValid = false;
            $validatorTransfer->errorMessage = $this->getErrorMessage($propertyTransfer);

            return $validatorTransfer;
        }

        if (!TypeEnum::isTransfer($propertyTransfer->type)) {
            $validatorTransfer->isValid = true;

            return $validatorTransfer;
        }

        return $this->classNameValidator->validate($propertyTransfer->type);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::PROPERTY_TYPE_UNSUPPORTED_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->type ?? '',
        );
    }
}
