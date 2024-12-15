<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config\Container;

use Picamator\TransferObject\Exception\ConfigTransferException;
use Picamator\TransferObject\Generated\ConfigTransfer;

class ConfigContainer
{
    private static ConfigInterface $config;

    public static function loadConfig(ConfigTransfer $configTransfer): void
    {
        self::$config = new Config(
            transferNamespace: $configTransfer->transferNamespace,
            transferPath: $configTransfer->transferPath,
            definitionPath: $configTransfer->definitionPath,
        );
    }

    /**
     * @throws \Picamator\TransferObject\Exception\ConfigTransferException
     */
    public static function getConfig(): ConfigInterface
    {
        if (!isset(self::$config)) {
            throw new ConfigTransferException('Config was not loaded. Run loadConfig() first.');
        }

        return self::$config;
    }
}
