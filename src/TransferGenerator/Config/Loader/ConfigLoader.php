<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader;

use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigContainer;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReaderInterface;

readonly class ConfigLoader implements ConfigLoaderInterface
{
    public function __construct(
        private ConfigReaderInterface $reader,
    ) {
    }

    public function loadConfig(string $configPath): ConfigTransfer
    {
        $configTransfer = $this->reader->getConfig($configPath);
        if ($configTransfer->validator->isValid) {
            ConfigContainer::loadConfig($configTransfer->content);
        }

        return $configTransfer;
    }
}
