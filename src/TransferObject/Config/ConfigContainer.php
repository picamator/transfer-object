<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

class ConfigContainer
{
    private static ConfigInterface $config;

    public static function loadConfig(
        string $transferNamespace,
        string $transferPath,
        string $definitionPath
    ): void {
        self::$config = new Config(
            transferNamespace: $transferNamespace,
            transferPath: $transferPath,
            definitionPath: $definitionPath
        );
    }

    public static function getConfig(): ConfigInterface
    {
        return self::$config;
    }
}
