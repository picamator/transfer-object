<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

abstract class AbstractPropertyExpander implements PropertyExpanderInterface
{
    use PropertyExpanderTrait;

    /**
     * @param array<string,string|array<int,string>|null> $propertyType
     *
     * @return string|array<string, string|array<int,string>|null>|null
     */
    abstract protected function matchType(array $propertyType): string|array|null;

    abstract protected function handleExpander(mixed $matchedType, DefinitionPropertyTransfer $propertyTransfer): void;
}
