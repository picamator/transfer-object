<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Filesystem;

use Picamator\TransferObject\Exception\GeneratorTransferException;
use Picamator\TransferObject\Transfer\Generated\HelperFilesystemTransfer;
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

readonly class DefinitionFilesystem implements DefinitionFilesystemInterface
{
    private const string FILE_NAME_PATTERN = '%s.transfer.yml';

    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public function appendFile(HelperFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilepath($filesystemTransfer);

        try {
            $this->filesystem->appendToFile($filePath, $filesystemTransfer->content);
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf('Cannot update file "%s".', $filePath),
                previous: $e,
            );
        }
    }

    public function deleteFile(HelperFilesystemTransfer $filesystemTransfer): void
    {
        $filePath = $this->getFilepath($filesystemTransfer);

        try {
            $this->filesystem->remove($filePath);
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf(
                    'Cannot delete previously generated file "%s".',
                    $filePath,
                ),
                previous: $e,
            );
        }
    }

    private function getFilepath(HelperFilesystemTransfer $filesystemTransfer): string
    {
        return $filesystemTransfer->definitionPath
            . DIRECTORY_SEPARATOR . sprintf(self::FILE_NAME_PATTERN, $filesystemTransfer->fileName);
    }
}
