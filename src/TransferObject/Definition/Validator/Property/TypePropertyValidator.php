<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Enum\UnsupportedTypeEnum;
use Picamator\TransferObject\Definition\Enum\TypeEnum;
use Picamator\TransferObject\Definition\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class TypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string PROPERTY_TYPE_UNSUPPORTED_ERROR_MESSAGE_TEMPLATE = 'Property "%s" type "%s" is not supported.';

    public function __construct(
        private ClassNameValidatorInterface $classNameValidator,
    ) {
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if ($propertyTransfer->type === null) {
            return $this->createSuccessMessageTransfer();
        }

        if (UnsupportedTypeEnum::isUnsupported($propertyTransfer->type)) {
            $errorMessage = $this->getErrorMessage($propertyTransfer);

            return $this->createErrorMessageTransfer($errorMessage);
        }

        if (!TypeEnum::isTransfer($propertyTransfer->type)) {
            return $this->createSuccessMessageTransfer();
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
