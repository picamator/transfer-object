<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader;

use Picamator\TransferObject\Generated\ConfigTransfer;

interface ConfigLoaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\YmlParserException
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function loadConfig(string $configPath): ConfigTransfer;
}
