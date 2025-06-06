<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\DefinitionTypeKeyEnum;

class RequiredTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string MISSED_REQUIRED_TYPE_ERROR_MESSAGE_TEMPLATE
        = 'Property "%s" type definition is missing or set multiple times.';

    public function isApplicable(DefinitionPropertyTransfer $propertyTransfer): bool
    {
        $definedTypes = $this->getDefinedTypes($propertyTransfer);

        return count($definedTypes) !== 1;
    }

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $errorMessage = $this->getErrorMessage($propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    /**
     * @return array<int,mixed>
     */
    private function getDefinedTypes(DefinitionPropertyTransfer $propertyTransfer): array
    {
        $definedTypes = [];
        foreach (DefinitionTypeKeyEnum::cases() as $definitionTypeKey) {
            $definedTypes[] = $propertyTransfer->{$definitionTypeKey->value};
        }

        return array_filter($definedTypes);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::MISSED_REQUIRED_TYPE_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
        );
    }
}
