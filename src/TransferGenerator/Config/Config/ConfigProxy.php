<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Config;

use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException;

final class ConfigProxy implements ConfigInterface
{
    private static ?ConfigInterface $config;

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

    public function getRelativeDefinitionPath(): string
    {
        return $this->getConfig()->getRelativeDefinitionPath();
    }

    public function getUuid(): string
    {
        return $this->getConfig()->getUuid();
    }

    public function getHashFileName(): string
    {
        return $this->getConfig()->getHashFileName();
    }

    public function getIsCacheEnabled(): bool
    {
        return $this->getConfig()->getIsCacheEnabled();
    }

    public static function loadConfig(ConfigInterface $config): void
    {
        self::$config = $config;
    }

    public static function resetConfig(): void
    {
        self::$config = null;
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    private function getConfig(): ConfigInterface
    {
        if (isset(self::$config)) {
            return self::$config;
        }

        throw new TransferGeneratorConfigNotFoundException(
            'Transfer Object generator configuration not found. Please load the configuration first.'
        );
    }
}
