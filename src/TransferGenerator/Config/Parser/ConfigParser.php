<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigContentBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Filter\ConfigFilterTrait;

readonly class ConfigParser implements ConfigParserInterface
{
    use ConfigFilterTrait;

    public function __construct(
        private YmlParserInterface $parser,
        private ConfigContentBuilderInterface $builder,
    ) {
    }

    public function parseConfig(string $configPath): ConfigContentTransfer
    {
        $configData = $this->parser->parseFile($configPath);
        $filteredConfigData = $this->filterConfig($configData);

        return $this->builder->createContentTransfer($filteredConfigData);
    }
}
