<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class ProtectedPropertyExpander extends AbstractPropertyExpander
{
    private const string PROTECTED_KEY = 'protected';

    protected function matchType(array $propertyType): string
    {
        return array_key_exists(self::PROTECTED_KEY, $propertyType) ? '1' : '0';
    }

    protected function handleExpander(string $matchedType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->isProtected = $matchedType === '1';
    }
}
