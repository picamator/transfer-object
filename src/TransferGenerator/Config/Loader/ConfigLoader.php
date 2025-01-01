<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader;

use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\Config;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigProxy;
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
            $config = new Config($configTransfer->content);
            ConfigProxy::loadConfig($config);
        }

        return $configTransfer;
    }
}
