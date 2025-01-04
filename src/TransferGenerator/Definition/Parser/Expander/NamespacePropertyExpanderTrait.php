<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

trait NamespacePropertyExpanderTrait
{
    private const string NAMESPACE_ALIAS_SEPARATOR = ' as ';

    protected function isNamespace(string $propertyName): bool
    {
        return str_contains($propertyName, '\\');
    }

    protected function getClassName(string $namespace): string
    {
        $alias = $this->getNamespaceAlias($namespace);
        if ($alias !== null) {
            return $alias;
        }

        /** @var string $className */
        $className = strrchr($namespace, '\\');

        return ltrim($className, '\\');
    }

    private function getNamespaceAlias(string $namespace): ?string
    {
        if (!str_contains($namespace, self::NAMESPACE_ALIAS_SEPARATOR)) {
            return null;
        }

        /** @var string $alias */
        $alias = strrchr($namespace, self::NAMESPACE_ALIAS_SEPARATOR);

        return trim($alias);
    }
}
