<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class FilesystemBuilder implements FilesystemBuilderInterface
{
    public function createFilesystemTransfer(
        DefinitionGeneratorTransfer $generatorTransfer,
    ): DefinitionFilesystemTransfer {
        $filesystemTransfer = new DefinitionFilesystemTransfer();
        $filesystemTransfer->fileName = $this->getFileName($generatorTransfer);
        $filesystemTransfer->definitionPath = $generatorTransfer->definitionPath;

        return $filesystemTransfer;
    }

    private function getFileName(DefinitionGeneratorTransfer $generatorTransfer): string
    {
        return lcfirst($generatorTransfer->content->className);
    }
}
