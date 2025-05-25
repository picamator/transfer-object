<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Shared\Validator\VariableValidatorTrait;

class NamePropertyValidator implements PropertyValidatorInterface
{
    use VariableValidatorTrait;
    use ValidatorMessageTrait;

    private const string INVALID_NAME_ERROR_MESSAGE_TEMPLATE = 'Invalid property name "%s".';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        return !$this->isValidVariable($propertyTransfer->propertyName);
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::INVALID_NAME_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
