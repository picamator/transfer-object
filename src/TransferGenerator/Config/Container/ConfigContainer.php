<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Container;

use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigException;
use Picamator\TransferObject\Generated\ConfigContentTransfer;

class ConfigContainer
{
    private static ConfigInterface $config;

    public static function loadConfig(ConfigContentTransfer $configTransfer): void
    {
        self::$config = new Config(
            transferNamespace: $configTransfer->transferNamespace,
            transferPath: $configTransfer->transferPath,
            definitionPath: $configTransfer->definitionPath,
        );
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigException
     */
    public static function getConfig(): ConfigInterface
    {
        if (!isset(self::$config)) {
            throw new TransferGeneratorConfigException('Config was not loaded. Run loadConfig() first.');
        }

        return self::$config;
    }
}
