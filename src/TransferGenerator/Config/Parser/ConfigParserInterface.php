<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

interface ConfigParserInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     */
    public function parseConfig(string $configPath): ConfigContentTransfer;
}
