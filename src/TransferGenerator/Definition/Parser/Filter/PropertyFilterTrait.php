<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Filter;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

trait PropertyFilterTrait
{
    /**
     * @return array<string,array<string,string|null>>
     */
    final protected function filterProperties(mixed $properties): array
    {
        if (!is_array($properties)) {
            return [];
        }

        /** @var array<string,array<string,string|null>> $filteredProperties */
        $filteredProperties = array_map(
            fn (mixed $propertyType): array => is_array($propertyType) ? $this->filterPropertyType($propertyType) : [],
            $properties
        );

        return $filteredProperties;
    }

    /**
     * @param array<string|int, mixed> $propertyType
     *
     * @return array<string,string|null>
     */
    private function filterPropertyType(array $propertyType): array
    {
        /** @var array<string,string|bool|null> $filteredType */
        $filteredType = array_filter($propertyType, $this->filterPropertyTypeItem(...), ARRAY_FILTER_USE_BOTH);

        /** @var array<string,string|null> $filteredType */
        $filteredType = array_map(
            fn (string|bool|null $item) => is_bool($item)
                ? BuildInTypeEnum::getTrueFalse($item)->value
                : $item,
            $filteredType
        );

        return $filteredType;
    }

    private function filterPropertyTypeItem(mixed $value, int|string $key): bool
    {
        if (is_int($key)) {
            return false;
        }

        return is_bool($value) || is_string($value) || is_null($value);
    }
}
