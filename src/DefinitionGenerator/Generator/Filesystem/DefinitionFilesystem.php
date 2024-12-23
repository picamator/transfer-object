<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem;

use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

readonly class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = '%s.transfer.yml';

    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public function appendFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilepath($filesystemTransfer);

        try {
            $this->filesystem->appendToFile($filePath, $filesystemTransfer->content);
        } catch (Throwable $e) {
            throw new DefinitionGeneratorException(
                sprintf('Cannot update file "%s".', $filePath),
                previous: $e,
            );
        }
    }

    public function deleteFile(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilepath($filesystemTransfer);

        try {
            $this->filesystem->remove($filePath);
        } catch (Throwable $e) {
            throw new DefinitionGeneratorException(
                sprintf(
                    'Cannot delete previously generated file "%s".',
                    $filePath,
                ),
                previous: $e,
            );
        }
    }

    private function getFilepath(DefinitionFilesystemTransfer $filesystemTransfer): string
    {
        return $filesystemTransfer->definitionPath
            . DIRECTORY_SEPARATOR . sprintf(self::FILE_NAME_PATTERN, $filesystemTransfer->fileName);
    }
}
