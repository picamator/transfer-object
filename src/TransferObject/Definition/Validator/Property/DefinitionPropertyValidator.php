<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class DefinitionPropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string PROPERTY_DEFINITION_EMPTY_ERROR_MESSAGE_TEMPLATE = 'Neither "type" nor "typeCollection" is set on "%s" property definition.';
    private const string PROPERTY_DEFINITION_DUPLICATION_ERROR_MESSAGE_TEMPLATE = 'Duplication property "%s" type. Only one of "type" or "typeCollection" should be defined.';

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $errorMessage = $this->getErrorMessage($propertyTransfer);
        if ($errorMessage === null) {
            return $this->createSuccessMessageTransfer();
        }

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(DefinitionPropertyTransfer $propertyTransfer): ?string
    {
        return match(true) {
            $propertyTransfer->type === null && $propertyTransfer->collectionType === null => sprintf(
                self::PROPERTY_DEFINITION_EMPTY_ERROR_MESSAGE_TEMPLATE,
                $propertyTransfer->propertyName,
            ),
            $propertyTransfer->type !== null && $propertyTransfer->collectionType !== null => sprintf(
                self::PROPERTY_DEFINITION_DUPLICATION_ERROR_MESSAGE_TEMPLATE,
                $propertyTransfer->propertyName,
            ),
            default => null,
        };
    }
}
