<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Parser;

use Picamator\TransferObject\Generated\ConfigContentTransfer;

interface ConfigParserInterface
{
    public function parseConfig(string $configPath): ConfigContentTransfer;
}
