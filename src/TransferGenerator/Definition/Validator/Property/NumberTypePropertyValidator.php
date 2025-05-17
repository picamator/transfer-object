<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use BcMath\Number;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

class NumberTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string INVALID_NUMBER_TYPE_ERROR_MESSAGE_TEMPLATE
        = 'Property "%s" type "%s" is not a BcMath\Number.';

    private const string EXTENSION_IS_NOT_LOADED_ERROR
        = 'PHP extension BCMath was not loaded. Please install and load extension';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return $propertyTransfer->numberType !== null;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if (!$this->isBcMathLoaded()) {
            return $this->createErrorMessageTransfer(self::EXTENSION_IS_NOT_LOADED_ERROR);
        }

        return $this->validateType($propertyTransfer);
    }

    private function validateType(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $numberClassName = $propertyTransfer->numberType?->namespace?->withoutAlias ?: '';

        if ($numberClassName === Number::class) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::INVALID_NUMBER_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyTransfer->numberType?->namespace->withoutAlias ?? '',
        );
    }

    private function isBcMathLoaded(): bool
    {
        return extension_loaded('bcmath');
    }
}
