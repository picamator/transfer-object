<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader;

use Picamator\TransferObject\Generated\ConfigTransfer;

interface ConfigLoaderInterface
{
    public function loadConfig(string $configPath): ConfigTransfer;
}
