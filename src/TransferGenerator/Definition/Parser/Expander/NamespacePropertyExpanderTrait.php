<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;

trait NamespacePropertyExpanderTrait
{
    private const string NAMESPACE_ALIAS_SEPARATOR = ' as ';

    protected function createDefinitionNamespaceTransfer(string $namespace): DefinitionNamespaceTransfer
    {
        $namespaceTransfer = new DefinitionNamespaceTransfer();
        $namespaceTransfer->fullName = $namespace;
        $namespaceTransfer->withoutAlias = $this->getWithoutAlias($namespace);
        $namespaceTransfer->baseName = $this->getBaseName($namespaceTransfer->withoutAlias);
        $namespaceTransfer->alias = $this->getAlias($namespace);

        return $namespaceTransfer;
    }

    protected function isNamespace(string $propertyType): bool
    {
        return str_contains($propertyType, '\\');
    }

    private function getAlias(string $namespace): ?string
    {
        if (!str_contains($namespace, self::NAMESPACE_ALIAS_SEPARATOR)) {
            return null;
        }

        /** @var string $alias */
        $alias = strrchr($namespace, self::NAMESPACE_ALIAS_SEPARATOR);

        return trim($alias);
    }

    private function getBaseName(string $withoutAlias): string
    {
        /** @var string $baseName */
        $baseName = strrchr($withoutAlias, '\\');

        return ltrim($baseName, '\\');
    }

    private function getWithoutAlias(string $namespace): string
    {
        if (!str_contains($namespace, self::NAMESPACE_ALIAS_SEPARATOR)) {
            return $namespace;
        }

        /** @var string $namespace */
        $namespace = strstr($namespace, self::NAMESPACE_ALIAS_SEPARATOR, true);

        return trim($namespace);
    }
}
