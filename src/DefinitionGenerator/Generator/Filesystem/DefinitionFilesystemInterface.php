<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem;

use Picamator\TransferObject\Generated\HelperFilesystemTransfer;

interface DefinitionFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     */
    public function appendFile(HelperFilesystemTransfer $filesystemTransfer): void;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     */
    public function deleteFile(HelperFilesystemTransfer $filesystemTransfer): void;
}
