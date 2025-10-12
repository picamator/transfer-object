<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\ReservedPropertyEnum;

readonly class ReservedNamePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string RESERVED_NAME_ERROR_MESSAGE_TEMPLATE = 'Reserved property name "%s".';

    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        if (ReservedPropertyEnum::tryFrom($propertyTransfer->propertyName) === null) {
            return null;
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
