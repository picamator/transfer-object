<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigContentBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Filter\ConfigNormalizerTrait;

readonly class ConfigParser implements ConfigParserInterface
{
    use ConfigNormalizerTrait;

    public function __construct(
        private YmlParserInterface $parser,
        private ConfigContentBuilderInterface $builder,
        private EnvironmentReaderInterface $environmentReader,
    ) {
    }

    public function parseConfig(string $configPath): ConfigContentTransfer
    {
        $configData = $this->parser->parseFile($configPath)
                |> $this->normalizeConfig(...)
                |> $this->expandConfig(...);

        return $this->builder->createContentTransfer($configData);
    }

    /**
     * @param array<string,string|bool> $configData
     *
     * @return array<string,string|bool>
     */
    private function expandConfig(array $configData): array
    {
        $configData[ConfigContentTransfer::UUID_PROP] = uniqid(more_entropy: true);
        $configData[ConfigContentTransfer::IS_CACHE_ENABLED_PROP] = $this->environmentReader->getIsCacheEnabled();

        return $configData;
    }
}
