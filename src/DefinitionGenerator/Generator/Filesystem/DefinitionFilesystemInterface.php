<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;

interface DefinitionFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function appendFile(DefinitionFilesystemTransfer $filesystemTransfer): void;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function deleteFile(DefinitionFilesystemTransfer $filesystemTransfer): void;
}
