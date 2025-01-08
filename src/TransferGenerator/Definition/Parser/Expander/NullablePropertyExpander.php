<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class NullablePropertyExpander extends AbstractPropertyExpander
{
    private const string REQUIRED_KEY = 'required';

    protected function isApplicable(array $propertyType): true
    {
        return true;
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->isNullable = !$this->getIsRequired($propertyType);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getIsRequired(array $propertyType): bool
    {
        return array_key_exists(self::REQUIRED_KEY, $propertyType);
    }
}
