<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Reader\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

interface PropertyExpanderInterface
{
    /**
     * @param array<string,string|bool> $propertyType
     */
    public function isApplicable(array $propertyType): bool;

    /**
     * @param array<string,string|bool> $propertyType
     */
    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void;
}
