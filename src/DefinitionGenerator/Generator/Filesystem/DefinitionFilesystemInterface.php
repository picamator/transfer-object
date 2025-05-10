<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;

interface DefinitionFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileAppenderException
     */
    public function appendFile(DefinitionFilesystemTransfer $filesystemTransfer): void;

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileAppenderException
     */
    public function closeFile(DefinitionFilesystemTransfer $filesystemTransfer): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function deleteFile(DefinitionFilesystemTransfer $filesystemTransfer): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function createDir(DefinitionFilesystemTransfer $filesystemTransfer): void;
}
