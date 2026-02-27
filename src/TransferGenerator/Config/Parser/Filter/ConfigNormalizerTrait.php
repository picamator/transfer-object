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
        if (!is_array($configData)) {
            return ConfigKeyEnum::getDefaultConfig();
        }

        $sectionData = $configData[self::CONFIG_SECTION_KEY] ?? null;

        return is_array($sectionData)
            ? $this->filterSectionData($sectionData)
            : ConfigKeyEnum::getDefaultConfig();
    }

    /**
     * @param array<string|int, mixed> $sectionData
     *
     * @return array<string,string|bool>
     */
    private function filterSectionData(array $sectionData): array
    {
        $filteredData = [];
        foreach (ConfigKeyEnum::getDefaultConfig() as $key => $defaultValue) {
            $sectionValue = $sectionData[$key] ?? null;
            $filteredData[$key] = is_string($sectionValue) ? $sectionValue : $defaultValue;
        }

        return $filteredData;
    }
}
