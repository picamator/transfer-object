<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use BackedEnum;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class EnumTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string INVALID_ENUM_TYPE_ERROR_MESSAGE_TEMPLATE
        = 'Property "%s" type "%s" is not a BakedEnum.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->enumType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $enumClassName = $propertyTransfer->enumType?->namespace?->withoutAlias ?: '';
        if (is_subclass_of($enumClassName, BackedEnum::class)) {
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
            $propertyTransfer->enumType?->namespace->withoutAlias ?? '',
        );
    }
}
