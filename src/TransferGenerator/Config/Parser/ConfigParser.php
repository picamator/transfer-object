<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Dependency\YmlParser\YmlParserInterface;
use Picamator\TransferObject\Generated\ConfigContentTransfer;

readonly class ConfigParser implements ConfigParserInterface
{
    public function __construct(
        private YmlParserInterface $parser,
        private ConfigContentBuilderInterface $builder,
    ) {
    }

    public function parseConfig(string $configPath): ConfigContentTransfer
    {
        $configData = $this->parser->parseFile($configPath);
        $configData = is_array($configData) ? $configData : [];

        return $this->builder->createContentTransfer($configData);
    }
}
