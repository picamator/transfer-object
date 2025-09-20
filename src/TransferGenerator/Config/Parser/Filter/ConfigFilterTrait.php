<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Filter;

use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;

trait ConfigFilterTrait
{
    private const string CONFIG_SECTION_KEY = 'generator';

    /**
     * @return array<string,string>
     */
    final protected function filterConfig(mixed $configData): array
    {
        if (!is_array($configData)) {
            return ConfigKeyEnum::getDefaultConfig();
        }

        $sectionData = $configData[self::CONFIG_SECTION_KEY] ?? [];
        $sectionData = is_array($sectionData) ? $sectionData : [];

        $filteredData = array_intersect_key($sectionData, ConfigKeyEnum::getConfigKeys());
        $filteredData = array_filter($filteredData, fn(mixed $item): bool => is_string($item));

        return $filteredData + ConfigKeyEnum::getDefaultConfig();
    }
}
