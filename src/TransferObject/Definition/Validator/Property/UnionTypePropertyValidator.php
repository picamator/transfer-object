<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Validator\Property;

use Picamator\TransferObject\Definition\Validator\ValidatorMessageTrait;
use Picamator\TransferObject\Transfer\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class UnionTypePropertyValidator implements PropertyValidatorInterface
{
    use ValidatorMessageTrait;

    private const string UNION_TYPE_SEPARATOR = '|';
    private const string PROPERTY_TYPE_UNION_ERROR_MESSAGE_TEMPLATE = 'Union property "%s" type "%s" is not supported.';

    public function validate(DefinitionPropertyTransfer $propertyTransfer): ValidatorMessageTransfer
    {
        $propertyType = $propertyTransfer->type;
        $propertyType ??= $propertyTransfer->collectionType;

        if ($propertyType !== null && !str_contains($propertyType, self::UNION_TYPE_SEPARATOR)) {
            return $this->createSuccessMessageTransfer();
        }

        $errorMessage = $this->getErrorMessage($propertyType, $propertyTransfer);

        return $this->createErrorMessageTransfer($errorMessage);
    }

    private function getErrorMessage(?string $propertyType, DefinitionPropertyTransfer $propertyTransfer): string
    {
        return sprintf(
            self::PROPERTY_TYPE_UNION_ERROR_MESSAGE_TEMPLATE,
            $propertyTransfer->propertyName,
            $propertyType ?? '',
        );
    }
}
