<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;

readonly class AttributesNamespaceBuilder implements NamespaceBuilderInterface
{
    private const array SHORTCUT_MAP = [
        'sf-assert:' => 'Symfony\Component\Validator\Constraints\\',
    ];

    public function __construct(
        private NamespaceBuilderInterface $namespaceBuilder,
    ) {
    }

    public function createNamespaceTransfer(string $namespace): DefinitionNamespaceTransfer
    {
        $namespace = $this->renderShortcut($namespace);

        return $this->namespaceBuilder->createNamespaceTransfer($namespace);
    }

    public static function renderShortcut(string $namespace): string
    {
        foreach (self::SHORTCUT_MAP as $shortcut => $fullName) {
            if (str_starts_with($namespace, $shortcut)) {
                return str_replace($shortcut, $fullName, $namespace);
            }
        }

        return $namespace;
    }
}
