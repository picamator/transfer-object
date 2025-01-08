<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

final class EnumTypePropertyExpander extends AbstractPropertyExpander
{
    private const string ENUM_TYPE_KEY = 'enumType';

    protected function isApplicable(array $propertyType): bool
    {
        return $this->getEnumType($propertyType) !== null;
    }

    protected function handleExpander(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->enumType = $this->getEnumType($propertyType);
    }

    /**
     * @param array<string,string|null> $propertyType
     */
    private function getEnumType(array $propertyType): ?string
    {
        $enumType = $propertyType[self::ENUM_TYPE_KEY] ?? null;

        return is_string($enumType) ? $enumType : null;
    }
}
