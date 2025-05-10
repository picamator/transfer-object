<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Shared\Filesystem\FileAppenderInterface;

readonly class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = DIRECTORY_SEPARATOR . '%s.transfer.yml';

    public function __construct(
        private FilesystemInterface $filesystem,
        private FileAppenderInterface $fileAppender,
    ) {
    }

    public function appendFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilePath($filesystemTransfer);
        $this->fileAppender->appendToFile($filePath, $filesystemTransfer->content);
    }

    public function closeFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilePath($filesystemTransfer);
        $this->fileAppender->closeFile($filePath);
    }

    public function deleteFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilePath($filesystemTransfer);
        $this->filesystem->remove($filePath);
    }

    public function createDir(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $dirPath = $filesystemTransfer->definitionPath;
        $this->filesystem->mkdir($dirPath);
    }

    private function getFilePath(DefinitionFilesystemTransfer $filesystemTransfer): string
    {
        return $filesystemTransfer->definitionPath
            . sprintf(self::FILE_NAME_PATTERN, $filesystemTransfer->fileName);
    }
}
