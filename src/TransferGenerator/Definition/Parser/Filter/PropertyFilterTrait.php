<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Parser\Filter;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;

trait PropertyFilterTrait
{
    /**
     * @return array<string,array<string,string|null>>
     */
    protected function filterProperties(mixed $properties): array
    {
        if (!is_array($properties)) {
            return [];
        }

        /** @var array<string,array<string,string|null>> $filteredProperties */
        $filteredProperties = array_map($this->filterPropertyType(...), $properties);

        return $filteredProperties;
    }

    /**
     * @param mixed $propertyType
     *
     * @return array<string,string|null>
     */
    private function filterPropertyType(mixed $propertyType): array
    {
        if (!is_array($propertyType)) {
            return [];
        }

        $filteredType = [];
        foreach ($propertyType as $key => $typeItem) {
            if (!is_string($key)) {
                continue;
            }

            if (is_bool($typeItem)) {
                $filteredType[$key] = BuildInTypeEnum::getTrueFalse($typeItem)->value;

                continue;
            }

            if (is_string($typeItem) || is_null($typeItem)) {
                $filteredType[$key] = $typeItem;
            }
        }

        return $filteredType;
    }
}
