<?php declare(strict_types=1);

namespace Picamator\TransferObject\Config;

use Picamator\TransferObject\Config\Filesystem\ConfigFilesystem;
use Picamator\TransferObject\Config\Filesystem\ConfigFilesystemInterface;
use Picamator\TransferObject\Config\Loader\ConfigLoader;
use Picamator\TransferObject\Config\Loader\ConfigLoaderInterface;
use Symfony\Component\Yaml\Parser;

readonly class ConfigFactory
{
    public function createConfigLoader(): ConfigLoaderInterface
    {
        return new ConfigLoader($this->createConfigFilesystem());
    }

    protected function createConfigFilesystem(): ConfigFilesystemInterface
    {
        return new ConfigFilesystem($this->createYmlParser());
    }

    protected function createYmlParser(): Parser
    {
        return new Parser();
    }
}
