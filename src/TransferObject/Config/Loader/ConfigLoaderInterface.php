<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Loader;

use Picamator\TransferObject\Generated\ConfigValidatorTransfer;

interface ConfigLoaderInterface
{
    public function loadConfig(string $configPath): ConfigValidatorTransfer;
}
