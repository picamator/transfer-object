<?php declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config;

use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderFactory;

readonly class ConfigFacade implements ConfigFacadeInterface
{
    public function loadConfig(string $configPath): ValidatorMessageTransfer
    {
        return new ConfigLoaderFactory()
            ->createConfigLoader()
            ->loadConfig($configPath);
    }
}
