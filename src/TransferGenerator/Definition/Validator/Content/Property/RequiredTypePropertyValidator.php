<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;

readonly class RequiredTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string MISSED_REQUIRED_TYPE_ERROR_MESSAGE_TEMPLATE
        = 'Property "%s" type definition is missing or set multiple times.';

    private const array TYPE_KEYS = [
        DefinitionPropertyTransfer::BUILD_IN_TYPE_PROP,
        DefinitionPropertyTransfer::TRANSFER_TYPE_PROP,
        DefinitionPropertyTransfer::COLLECTION_TYPE_PROP,
        DefinitionPropertyTransfer::ENUM_TYPE_PROP,
        DefinitionPropertyTransfer::DATE_TIME_TYPE_PROP,
        DefinitionPropertyTransfer::NUMBER_TYPE_PROP,
    ];

    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): true
    {
        return true;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ?ValidatorMessageTransfer
    {
        if ($this->isUniqueDefinedType($propertyTransfer)) {
            return null;
        }

        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function isUniqueDefinedType(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        $count = 0;

        foreach (self::TYPE_KEYS as $key) {
            $value = $propertyTransfer->{$key};
            if ($value !== null) {
                $count++;
            }

            if ($count > 1) {
                return false;
            }
        }

        return $count === 1;
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::MISSED_REQUIRED_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
