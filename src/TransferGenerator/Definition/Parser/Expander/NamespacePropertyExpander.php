<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyNamespaceTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class NamespacePropertyExpander implements PropertyExpanderInterface
{
    private const string TYPE_KEY = 'type';
    private const string COLLECTION_TYPE_KEY = 'collectionType';

    private const string NAMESPACE_ALIAS_SEPARATOR = ' as ';

    public function isApplicable(array $propertyType): bool
    {
        $fullName = $this->getFullName($propertyType);

        return $fullName !== null && str_contains($fullName, '\\');
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $fullName = $this->getFullName($propertyType) ?: '';

        $namespaceTransfer = new DefinitionPropertyNamespaceTransfer();
        $namespaceTransfer->fullName = $fullName;
        $namespaceTransfer->withoutAlias = $this->getWithoutAlias($fullName);
        $namespaceTransfer->baseName = $this->getBaseName($namespaceTransfer->withoutAlias);
        $namespaceTransfer->alias = $this->getAlias($fullName);

        $propertyTransfer->namespace = $namespaceTransfer;
    }

    private function getAlias(string $fullName): ?string
    {
        if (!str_contains($fullName, self::NAMESPACE_ALIAS_SEPARATOR)) {
            return null;
        }

        /** @var string $alias */
        $alias = strrchr($fullName, self::NAMESPACE_ALIAS_SEPARATOR);

        return trim($alias);
    }

    private function getBaseName(string $withoutAlias): string
    {
        /** @var string $baseName */
        $baseName = strrchr($withoutAlias, '\\');

        return ltrim($baseName, '\\');
    }

    private function getWithoutAlias(string $fullName): string
    {
        if (!str_contains($fullName, self::NAMESPACE_ALIAS_SEPARATOR)) {
            return $fullName;
        }

        /** @var string $fullName */
        $fullName = strstr($fullName, self::NAMESPACE_ALIAS_SEPARATOR, true);

        return trim($fullName);
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getFullName(array $propertyType): ?string
    {
        $namespace = $propertyType[self::TYPE_KEY] ?? $propertyType[self::COLLECTION_TYPE_KEY] ?? null;

        return !is_string($namespace) ? null : $namespace;
    }
}
