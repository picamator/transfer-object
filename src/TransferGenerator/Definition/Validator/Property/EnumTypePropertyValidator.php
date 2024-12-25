<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use BackedEnum;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;

readonly class EnumTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string INVALID_ENUM_TYPE_ERROR_MESSAGE_TEMPLATE = 'Property "%s" type "%s" is not BakedEnum.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->enumType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if (is_subclass_of($propertyTransfer->enumType, BackedEnum::class)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::INVALID_ENUM_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->enumType ?? '',
        );
    }
}
