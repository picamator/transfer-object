<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class CollectionTypePropertyExpander implements PropertyExpanderInterface
{
    private const string COLLECTION_TYPE_KEY = 'collectionType';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getCollectionType($propertyType) !== null;
    }

    public function isNextAllowed(): false
    {
        return false;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->collectionType = $this->getCollectionType($propertyType);
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
