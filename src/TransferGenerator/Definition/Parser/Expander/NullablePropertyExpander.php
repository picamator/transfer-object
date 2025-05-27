<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class NullablePropertyExpander extends AbstractPropertyExpander
{
    private const string REQUIRED_KEY = 'required';

    protected function matchType(array $propertyType): string
    {
        return array_key_exists(self::REQUIRED_KEY, $propertyType) ? '1' : '0';
    }

    protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->isNullable = $matchedType === '0';
    }
}
