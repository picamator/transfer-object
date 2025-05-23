<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\TypePrefixEnum;

readonly class EmbeddedTypeBuilder implements EmbeddedTypeBuilderInterface
{
    public function __construct(private NamespaceBuilderInterface $namespaceBuilder)
    {
    }

    public function createTypeTransfer(string $type): DefinitionEmbeddedTypeTransfer
    {
        $typeTransfer = new DefinitionEmbeddedTypeTransfer();

        $namespaceTransfer = $this->namespaceBuilder->createNamespaceTransfer($type);
        $typeTransfer->name = $namespaceTransfer->alias ?: $namespaceTransfer->baseName;
        $typeTransfer->namespace = $namespaceTransfer;

        return $typeTransfer;
    }

    public function createPrefixTypeTransfer(string $type): DefinitionEmbeddedTypeTransfer
    {
        if ($this->isNamespace($type)) {
            return $this->createTypeTransfer($type);
        }

        $typeTransfer = new DefinitionEmbeddedTypeTransfer();
        $typeTransfer->name = $type . TypePrefixEnum::TRANSFER->value;

        return $typeTransfer;
    }

    private function isNamespace(string $propertyType): bool
    {
        return str_contains($propertyType, '\\');
    }
}
