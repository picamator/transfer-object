<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

readonly class ReservedNamePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string RESERVED_NAME_ERROR_MESSAGE_TEMPLATE = 'Reserved property name "%s".';

    private const array RESERVED_PROPERTIES = [
        '_data',
        '_attributeCache',
    ];

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        if (!in_array($propertyTransfer->propertyName, self::RESERVED_PROPERTIES, true)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::RESERVED_NAME_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
