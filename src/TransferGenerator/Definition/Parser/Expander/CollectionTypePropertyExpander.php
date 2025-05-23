<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

final class CollectionTypePropertyExpander extends AbstractPropertyExpander
{
    use NamespacePropertyExpanderTrait;

    private const string COLLECTION_TYPE_KEY = 'collectionType';

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $collectionType = $this->getCollectionType($propertyType);
        if ($collectionType === null) {
            return;
        }

        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $propertyTransfer->collectionType = $typeTransfer;

        if (!$this->isNamespace($collectionType)) {
            $typeTransfer->name = $collectionType . TypePrefixEnum::TRANSFER->value;

            return;
        }

        $namespaceTransfer = $this->createDefinitionNamespaceTransfer($collectionType);

        $typeTransfer->name = $namespaceTransfer->alias ?: $namespaceTransfer->baseName;
        $typeTransfer->namespace = $namespaceTransfer;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getCollectionType(array $propertyType): ?string
    {
        $collectionType = $propertyType[self::COLLECTION_TYPE_KEY] ?? null;

        return is_string($collectionType) ? $collectionType : null;
    }
}
