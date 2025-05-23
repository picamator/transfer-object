<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class NumberTypePropertyExpander extends AbstractPropertyExpander
{
    use NamespacePropertyExpanderTrait;

    private const string NUMBER_TYPE_KEY = 'numberType';

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $numberType = $this->getNumberType($propertyType);
        if ($numberType === null) {
            return;
        }

        $namespaceTransfer = $this->createDefinitionNamespaceTransfer($numberType);

        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = $namespaceTransfer->alias ?: $namespaceTransfer->baseName;
        $typeTransfer->namespace = $namespaceTransfer;

        $propertyTransfer->numberType = $typeTransfer;
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getNumberType(array $propertyType): ?string
    {
        $numberType = $propertyType[self::NUMBER_TYPE_KEY] ?? null;

        return is_string($numberType) ? $numberType : null;
    }
}
