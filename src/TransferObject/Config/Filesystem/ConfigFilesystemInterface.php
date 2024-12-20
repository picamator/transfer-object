<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Config\Filesystem;

interface ConfigFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\ConfigTransferException
     */
    public function exists(string $configPath) : bool;
}
