<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser\Filter;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;

trait ConfigFilterTrait
{
    private const string CONFIG_SECTION_KEY = 'generator';

    protected const array DEFAULT_CONTENT_DATA = [
        ConfigContentTransfer::TRANSFER_NAMESPACE => '',
        ConfigContentTransfer::TRANSFER_PATH => '',
        ConfigContentTransfer::DEFINITION_PATH => '',
    ];

    /**
     * @return array<string,string>
     */
    private function filterConfig(mixed $configData): array
    {
        if (!is_array($configData)) {
            return self::DEFAULT_CONTENT_DATA;
        }

        $sectionData = $configData[self::CONFIG_SECTION_KEY] ?? [];
        $sectionData = is_array($sectionData) ? $sectionData : [];

        $filteredData = array_intersect_key($sectionData, ConfigKeyEnum::getValueName());
        $filteredData = array_filter($filteredData, fn(mixed $item): bool => is_string($item));

        return array_merge(self::DEFAULT_CONTENT_DATA, $filteredData);
    }
}
