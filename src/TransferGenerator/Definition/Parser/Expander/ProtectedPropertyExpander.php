<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class ProtectedPropertyExpander extends AbstractPropertyExpander
{
    private const string PROTECTED_KEY = 'protected';

    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    protected function isApplicable(array $propertyType): true
    {
        return true;
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->isProtected = $this->getIsProtected($propertyType);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getIsProtected(array $propertyType): bool
    {
        return array_key_exists(self::PROTECTED_KEY, $propertyType);
    }
}
