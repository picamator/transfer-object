<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;
use Picamator\TransferObject\TransferGenerator\Config\Environment\ConfigEnvironmentRenderInterface;

readonly class ConfigContentBuilder implements ConfigContentBuilderInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    public function __construct(
        private ConfigEnvironmentRenderInterface $environmentRender,
    ) {
    }

    public function createContentTransfer(array $configData): ConfigContentTransfer
    {
        $configSection = $this->filterConfigData($configData);
        $contentTransfer = new ConfigContentTransfer()->fromArray($configSection);

        return $this->renderPathKeys($contentTransfer);
    }

    private function renderPathKeys(ConfigContentTransfer $contentTransfer): ConfigContentTransfer
    {
        foreach (ConfigKeyEnum::getPathKeys() as $key) {
            $contentTransfer->{$key->value} = $this->environmentRender->renderProjectRoot(
                $contentTransfer->{$key->value} ?? '',
            );
        }

        return $contentTransfer;
    }

    /**
     * @param array<string,mixed> $sectionData
     *
     * @return array<string,string>
     */
    private function filterConfigData(array $sectionData): array
    {
        $sectionData = $sectionData[self::CONFIG_SECTION_KEY] ?? [];
        $sectionData = is_array($sectionData) ? $sectionData : [];

        $filteredData = array_intersect_key($sectionData, ConfigKeyEnum::getValueName());

        return array_filter($filteredData, fn(mixed $item): bool => is_string($item));
    }
}
