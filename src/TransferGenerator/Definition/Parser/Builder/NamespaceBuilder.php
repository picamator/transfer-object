<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Builder;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;

readonly class NamespaceBuilder implements NamespaceBuilderInterface
{
    private const string NAMESPACE_ALIAS_SEPARATOR = ' as ';
    private const string SPACE_REGEX = '#\s+#';

    public function createNamespaceTransfer(string $namespace): DefinitionNamespaceTransfer
    {
        $namespace = $this->filterNamespace($namespace);

        $namespaceTransfer = new DefinitionNamespaceTransfer();
        $namespaceTransfer->fullName = $namespace;
        $namespaceTransfer->withoutAlias = $this->getWithoutAlias($namespace);
        $namespaceTransfer->baseName = $this->getBaseName($namespaceTransfer->withoutAlias);
        $namespaceTransfer->alias = $this->getAlias($namespace);

        return $namespaceTransfer;
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
        $baseName = strrchr($withoutAlias, '\\');
        if ($baseName === false) {
            return $withoutAlias;
        }

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

    private function filterNamespace(string $namespace): string
    {
        $namespace = str_ireplace(
            self::NAMESPACE_ALIAS_SEPARATOR,
            self::NAMESPACE_ALIAS_SEPARATOR,
            $namespace,
        );

        /** @var string $namespace */
        $namespace = preg_replace(self::SPACE_REGEX, ' ', $namespace);

        return $namespace;
    }
}
