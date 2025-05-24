<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Enum\ConfigKeyEnum;

readonly class ConfigParser implements ConfigParserInterface
{
    private const string CONFIG_SECTION_KEY = 'generator';

    private const array DEFAULT_CONTENT_DATA = [
        ConfigContentTransfer::TRANSFER_NAMESPACE => '',
        ConfigContentTransfer::TRANSFER_PATH => '',
        ConfigContentTransfer::DEFINITION_PATH => '',
    ];

    public function __construct(
        private YmlParserInterface $parser,
        private ConfigContentBuilderInterface $builder,
    ) {
    }

    public function parseConfig(string $configPath): ConfigContentTransfer
    {
        $configData = $this->parser->parseFile($configPath);

        /** @var array<string, mixed> $configData */
        $configData = is_array($configData) ? $configData : [];
        $filteredConfigData = $this->filterConfigData($configData);

        return $this->builder->createContentTransfer($filteredConfigData);
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

        $filteredData = array_filter($filteredData, fn(mixed $item): bool => is_string($item));

        return array_merge(self::DEFAULT_CONTENT_DATA, $filteredData);
    }
}
