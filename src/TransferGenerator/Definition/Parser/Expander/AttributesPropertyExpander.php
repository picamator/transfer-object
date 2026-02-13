<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionAttributeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilderInterface;

final class AttributesPropertyExpander implements PropertyExpanderInterface
{
    use PropertyExpanderTrait;

    private const string ATTRIBUTES_KEY = 'attributes';

    private const string ATTRIBUTES_REGEX = '#^(?<namespace>[^()]+)\s*(?<arguments>.*)$#';

    public function __construct(
        private readonly NamespaceBuilderInterface $namespaceBuilder,
    ) {
    }

    /**
     * @param array<string, string|array<int,string>|null> $propertyType
     *
     * @return array<int,string>|null
     */
    protected function matchType(array $propertyType): ?array
    {
        /** @var array<int,string>|null $matchType */
        $matchType = $propertyType[self::ATTRIBUTES_KEY] ?? null;

        return $matchType;
    }

    /**
     * @param array<int,string> $matchedType
     */
    protected function handleExpander(array $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        foreach ($matchedType as $attribute) {
            $attributeTransfer = $this->getAttributeTransfer($attribute);
            if ($attributeTransfer === null) {
                continue;
            }

            $propertyTransfer->attributes->append($attributeTransfer);
        }
    }

    private function getAttributeTransfer(string $attribute): ?DefinitionAttributeTransfer
    {
        if (preg_match(self::ATTRIBUTES_REGEX, $attribute, $matches) !== 1) {
            return null;
        }

        $namespace = $matches['namespace'];
        $namespaceTransfer = $this->namespaceBuilder->createNamespaceTransfer($namespace);

        $builtInTypeTransfer = new DefinitionAttributeTransfer();
        $builtInTypeTransfer->arguments = $matches['arguments'];
        $builtInTypeTransfer->namespace = $namespaceTransfer;

        return $builtInTypeTransfer;
    }
}
