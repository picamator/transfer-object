<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder\EmbeddedTypeBuilderInterface;

final class CollectionTypePropertyExpander extends AbstractPropertyExpander
{
    private const string COLLECTION_TYPE_KEY = 'collectionType';

    public function __construct(
        private readonly EmbeddedTypeBuilderInterface $typeBuilder,
    ) {
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $collectionType = $propertyType[self::COLLECTION_TYPE_KEY] ?? null;
        if ($collectionType === null) {
            return;
        }

        $propertyTransfer->collectionType = $this->typeBuilder->createPrefixTypeTransfer($collectionType);
    }
}
