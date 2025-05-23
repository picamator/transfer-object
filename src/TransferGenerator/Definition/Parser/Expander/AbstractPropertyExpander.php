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
        $this->handleExpander($propertyType, $propertyTransfer);

        $this->nextExpander?->expandPropertyTransfer($propertyType, $propertyTransfer);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    abstract protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void;
}
