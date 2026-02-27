<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Filter;

use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;

trait ConfigNormalizerTrait
{
    private const string CONFIG_SECTION_KEY = 'generator';

    /**
     * @return array<string,string|bool>
     */
    final protected function normalizeConfig(mixed $configData): array
    {
        $defaultConfig = ConfigKeyEnum::getDefaultConfig();
        if (!is_array($configData)) {
            return $defaultConfig;
        }

        $sectionData = $configData[self::CONFIG_SECTION_KEY] ?? null;
        if (!is_array($sectionData)) {
            return $defaultConfig;
        }

        $filteredData = [];
        foreach ($defaultConfig as $key => $defaultValue) {
            $sectionValue = $sectionData[$key] ?? null;
            $filteredData[$key] = is_string($sectionValue) ? $sectionValue : $defaultValue;
        }

        return $filteredData;
    }
}
