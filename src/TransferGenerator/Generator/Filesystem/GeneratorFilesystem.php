<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use ArrayObject;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

readonly class GeneratorFilesystem implements GeneratorFilesystemInterface
{
    use FilesystemTrait;

    private const string TRANSFER_FILE_EXTENSION = '.php';

    public function __construct(
        private FilesystemInterface $filesystem,
        private ConfigInterface $config,
    ) {
    }

    public function createTempDir(): void
    {
        $temporaryPath = $this->getTemporaryPath();

        $this->deleteTempDir();
        $this->filesystem->mkdir($temporaryPath);
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function deleteTempDir(): void
    {
        $temporaryPath = $this->getTemporaryPath();
        if ($this->filesystem->exists($temporaryPath)) {
            $this->filesystem->remove($temporaryPath);
        }
    }

    public function writeTempFile(TransferGeneratorContentTransfer $contentTransfer): void
    {
        $fileName = $this->getFileName($contentTransfer->className);
        $filePath = $this->getTemporaryPath($fileName);

        if ($this->filesystem->exists($filePath)) {
            throw new TransferGeneratorException(
                sprintf('Cannot save file "%s". A file with the same name already exists.', $filePath),
            );
        }

        $this->filesystem->dumpFile($filePath, $contentTransfer->content);
    }

    public function rotateFiles(ArrayObject $toCopyClassNames, ArrayObject $toDeleteClassNames): void
    {
        if ($toCopyClassNames->count() > 0) {
            $this->renameTempFiles($toCopyClassNames);
        }

        if ($toDeleteClassNames->count() > 0) {
            $this->deleteFiles($toDeleteClassNames);
        }
    }

    /**
     * @param \ArrayObject<int, string> $classNames
     */
    private function deleteFiles(ArrayObject $classNames): void
    {
        $fileNames = $this->getFileNames($classNames);
        foreach ($fileNames as $fileName) {
            $filePath = $this->getTransferPath($fileName);
            $this->filesystem->remove($filePath);
        }
    }

    /**
     * @param \ArrayObject<int, string> $classNames
     */
    private function renameTempFiles(ArrayObject $classNames): void
    {
        $fileNames = $this->getFileNames($classNames);
        foreach ($fileNames as $fileName) {
            $originalFile = $this->getTemporaryPath($fileName);
            $targetFile = $this->getTransferPath($fileName);

            $this->filesystem->rename($originalFile, $targetFile, overwrite: true);
        }
    }

    /**
     * @param \ArrayObject<int, string> $classNames
     *
     * @return array<int, string>
     */
    private function getFileNames(ArrayObject $classNames): array
    {
        $fileNames = [];
        foreach ($classNames as $className) {
            $fileNames[] = $this->getFileName($className);
        }

        return $fileNames;
    }

    private function getFileName(string $className): string
    {
        return $className . self::TRANSFER_FILE_EXTENSION;
    }
}
