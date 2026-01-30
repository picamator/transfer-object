<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigContentBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Filter\ConfigNormalizerTrait;

readonly class ConfigParser implements ConfigParserInterface
{
    use ConfigNormalizerTrait;

    public function __construct(
        private YmlParserInterface $parser,
        private ConfigContentBuilderInterface $builder,
    ) {
    }

    public function parseConfig(string $configPath): ConfigContentTransfer
    {
        $configData = $this->parser->parseFile($configPath);
        $normalizedConfigData = $this->normalizeConfig($configData);

        return $this->builder->createContentTransfer($normalizedConfigData);
    }
}
