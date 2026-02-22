<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;

readonly class AttributesNamespaceBuilder implements NamespaceBuilderInterface
{
    /**
     * @var array<string, string>
     */
    protected const array SHORTCUT_PATTERN_MAP = [
        '#^(?<shortcut>sf-assert:\s*)(?<className>.+)$#' => 'Symfony\Component\Validator\Constraints\\',
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

    private function renderShortcut(string $namespace): string
    {
        foreach (static::SHORTCUT_PATTERN_MAP as $pattern => $replacement) {
            if (preg_match($pattern, $namespace, $matches) !== 1) {
                continue;
            }

            return $replacement . $matches['className'];
        }

        return $namespace;
    }
}
