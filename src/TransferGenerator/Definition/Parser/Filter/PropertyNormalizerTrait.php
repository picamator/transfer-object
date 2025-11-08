<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Filter;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\DefinitionKeyEnum;

trait PropertyNormalizerTrait
{
    /**
     * @return array<string,array<string,string|null>>
     */
    final protected function normalizeProperties(mixed $properties): array
    {
        if (!is_array($properties)) {
            return [];
        }

        /** @var array<string,array<string,string|null>> $filteredProperties */
        $filteredProperties = array_map(
            fn(mixed $property): array => is_array($property) ? $this->normalizeProperty($property) : [],
            $properties
        );

        return $filteredProperties;
    }

    /**
     * @param array<string|int, mixed> $property
     *
     * @return array<string,string|array<int,string>|null>
     */
    private function normalizeProperty(array $property): array
    {
        /** @var array<string,string|array<int,string>|null> $filteredProperty */
        $filteredProperty = [];
        foreach ($property as $key => $value) {
            if (is_int($key)) {
                continue;
            }

            $keyEnum = DefinitionKeyEnum::tryFrom($key);
            if ($keyEnum === null) {
                continue;
            }

            $filteredProperty[$key] = $keyEnum->normalizeValue($value);
        }

        return $filteredProperty;
    }
}
