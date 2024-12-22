<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Config\Loader\Filesystem;

interface ConfigFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\ConfigTransferException
     */
    public function exists(string $configPath) : bool;
}
