<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

use Picamator\TransferObject\Transfer\Generated\ValidatorMessageTransfer;

readonly class ConfigFacade implements ConfigFacadeInterface
{
    public function loadConfig(string $configPath): ValidatorMessageTransfer
    {
        return new ConfigFactory()
            ->createConfigLoader()
            ->loadConfig($configPath);
    }
}
