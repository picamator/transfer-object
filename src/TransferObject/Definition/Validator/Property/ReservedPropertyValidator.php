<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Enum\ReservedPropertyEnum;
use Picamator\TransferObject\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class ReservedPropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string PROPERTY_NAME_INVALID_ERROR_MESSAGE_TEMPLATE = 'Cannot use reserved "%s" property name.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if (!ReservedPropertyEnum::tryFrom($propertyTransfer->propertyName)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::PROPERTY_NAME_INVALID_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
