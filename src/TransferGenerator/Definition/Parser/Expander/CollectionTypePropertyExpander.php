<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

readonly class CollectionTypePropertyExpander implements PropertyExpanderInterface
{
    private const string COLLECTION_TYPE_KEY = 'collectionType';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getCollectionType($propertyType) !== null;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $collectionType = $this->getCollectionType($propertyType) ?: '';
        if ($propertyTransfer->namespace === null) {
            $propertyTransfer->collectionType = $collectionType . TypePrefixEnum::TRANSFER->value;

            return;
        }

        $propertyTransfer->collectionType =
            $propertyTransfer->namespace->alias ?: $propertyTransfer->namespace->baseName;
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getCollectionType(array $propertyType): ?string
    {
        $collectionType = $propertyType[self::COLLECTION_TYPE_KEY] ?? null;

        return is_string($collectionType) ? $collectionType : null;
    }
}
