<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

readonly class EnumTypePropertyExpander implements PropertyExpanderInterface
{
    private const string ENUM_TYPE_KEY = 'enumType';

    public function isApplicable(array $propertyType): bool
    {
        return $this->getEnumType($propertyType) !== null;
    }

    public function isNextAllowed(): false
    {
        return false;
    }

    public function expandPropertyTransfer(array $propertyType, DefinitionPropertyTransfer $propertyTransfer): void
    {
        $propertyTransfer->enumType = $this->getEnumType($propertyType);
    }

    /**
     * @param array<string,string|bool> $propertyType
     */
    private function getEnumType(array $propertyType): ?string
    {
        $enumType = $propertyType[self::ENUM_TYPE_KEY] ?? null;

        return is_string($enumType) ? $enumType : null;
    }
}
