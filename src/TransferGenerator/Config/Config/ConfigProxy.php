<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Config;

use Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException;

final class ConfigProxy implements ConfigInterface
{
    private static ConfigInterface $config;

    public function getTransferNamespace(): string
    {
        return $this->getConfig()->getTransferNamespace();
    }

    public function getTransferPath(): string
    {
        return $this->getConfig()->getTransferPath();
    }

    public function getDefinitionPath(): string
    {
        return $this->getConfig()->getDefinitionPath();
    }

    public static function loadConfig(ConfigInterface $config): void
    {
        self::$config = $config;
    }

    private function getConfig(): ConfigInterface
    {
        if (!isset(self::$config)) {
            throw new ConfigNotFoundException(
                'Transfer Object generator configuration not found. Please load configuration first.'
            );
        }

        return self::$config;
    }
}
