<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

trait PropertyExpanderTrait
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
}
