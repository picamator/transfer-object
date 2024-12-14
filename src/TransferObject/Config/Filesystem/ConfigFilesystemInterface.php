<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Filesystem;

use Picamator\TransferObject\Generated\ConfigTransfer;

interface ConfigFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\ConfigTransferException
     */
    public function getConfig(string $configPath): ConfigTransfer;
}
