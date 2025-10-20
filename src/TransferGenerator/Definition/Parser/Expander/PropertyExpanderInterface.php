<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

interface PropertyExpanderInterface
{
    public function setNextExpander(PropertyExpanderInterface $expander): PropertyExpanderInterface;

    /**
     * @param array<string,string|array<int,string>|null> $propertyType
     */
    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void;
}
