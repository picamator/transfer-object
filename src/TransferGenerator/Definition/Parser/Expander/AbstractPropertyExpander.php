<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

abstract class AbstractPropertyExpander implements PropertyExpanderInterface
{
    private ?PropertyExpanderInterface $nextExpander = null;

    public function setNextExpander(PropertyExpanderInterface $expander): PropertyExpanderInterface
    {
        $this->nextExpander = $expander;

        return $expander;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $matchedType = $this->matchType($propertyType);
        if ($matchedType !== null) {
            $this->handleExpander($matchedType, $propertyTransfer);
        }

        $this->nextExpander?->expandPropertyTransfer($propertyType, $propertyTransfer);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    abstract protected function matchType(array $propertyType): ?string;

    abstract protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void;
}
