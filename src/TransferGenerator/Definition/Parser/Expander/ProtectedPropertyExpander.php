<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class ProtectedPropertyExpander extends AbstractPropertyExpander
{
    private const string PROTECTED_KEY = 'protected';

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->isProtected = array_key_exists(self::PROTECTED_KEY, $propertyType);
    }
}
