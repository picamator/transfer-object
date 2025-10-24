<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

abstract class AbstractPropertyExpander implements PropertyExpanderInterface
{
    use PropertyExpanderTrait;

    /**
     * @param array<string,string|array<int,string>|null> $propertyType
     */
    abstract protected function matchType(array $propertyType): ?string;

    abstract protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void;
}
