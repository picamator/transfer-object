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
        $defaultConfig = ConfigKeyEnum::getDefaultConfig();
        if (!is_array($configData)) {
            return $defaultConfig;
        }

        $sectionData = $configData[self::CONFIG_SECTION_KEY] ?? [];
        if ($sectionData === [] || !is_array($sectionData)) {
            return $defaultConfig;
        }

        $filteredData = array_intersect_key($sectionData, $defaultConfig);
        $filteredData = array_filter($filteredData, 'is_string');

        return $filteredData + $defaultConfig;
    }
}
