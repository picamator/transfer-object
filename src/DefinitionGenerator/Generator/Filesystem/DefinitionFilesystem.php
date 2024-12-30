<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;

readonly class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = '%s.transfer.yml';

    public function __construct(
        private FilesystemInterface $filesystem,
    ) {
    }

    public function appendFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilepath($filesystemTransfer);
        $this->filesystem->appendToFile($filePath, $filesystemTransfer->content);
    }

    public function deleteFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilepath($filesystemTransfer);
        $this->filesystem->remove($filePath);
    }

    private function getFilepath(DefinitionFilesystemTransfer $filesystemTransfer): string
    {
        return $filesystemTransfer->definitionPath
            . DIRECTORY_SEPARATOR . sprintf(self::FILE_NAME_PATTERN, $filesystemTransfer->fileName);
    }
}
