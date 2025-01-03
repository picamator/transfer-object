<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class NullablePropertyExpander implements PropertyExpanderInterface
{
    private const string REQUIRED_KEY = 'required';

    public function isApplicable(array $propertyType): true
    {
        return true;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->isNullable = !$this->getIsRequired($propertyType);
    }

    public function isNextAllowed(): true
    {
        return true;
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getIsRequired(array $propertyType): bool
    {
        return array_key_exists(self::REQUIRED_KEY, $propertyType);
    }
}
