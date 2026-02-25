<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Enum\FilesystemEnum;

readonly class GeneratorFilesystem implements GeneratorFilesystemInterface
{
    use FilesystemTrait;

    private const string TRANSFER_FILE_EXTENSION = FilesystemEnum::TRANSFER_FILE_EXTENSION->value;
    private const string TRANSFER_FILE_NAME_PATTERN = FilesystemEnum::TRANSFER_FILE_NAME_PATTERN->value;

    private const string CACHE_FILE_NAME = FilesystemEnum::CACHE_FILE_NAME->value;

    public function __construct(
        private FilesystemInterface $filesystem,
        private FinderInterface $finder,
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

    public function rotateTempDir(array $deleteClassNames): void
    {
        if (count($deleteClassNames) !== 0) {
            $this->deleteOldFiles($deleteClassNames);
        }

        $this->copyTempFiles();
        $this->deleteTempDir();
    }

    public function writeFile(TransferGeneratorContentTransfer $contentTransfer): void
    {
        $filePath = $this->getTemporaryPath()
            . DIRECTORY_SEPARATOR
            . $contentTransfer->className
            . self::TRANSFER_FILE_EXTENSION;

        if ($this->filesystem->exists($filePath)) {
            throw new TransferGeneratorException(
                sprintf('Cannot save file "%s". A file with the same name already exists.', $filePath),
            );
        }

        $this->filesystem->dumpFile($filePath, $contentTransfer->content);
    }

    /**
     * @param array<int, string> $deleteClassNames
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    private function deleteOldFiles(array $deleteClassNames): void
    {
        /** @var array<string,mixed> $deleteFiles */
        $deleteFiles = array_map(
            fn (string $className): string
                => $this->config->getTransferPath() . DIRECTORY_SEPARATOR . $className . self::TRANSFER_FILE_EXTENSION,
            $deleteClassNames,
        );

        $this->filesystem->remove($deleteFiles);
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    private function copyTempFiles(): void
    {
        $finder = $this->finder->findFilesInDirectory(
            filePattern: self::TRANSFER_FILE_NAME_PATTERN,
            dirName: $this->getTemporaryPath(),
        );

        $destinationPath = $this->config->getTransferPath() . DIRECTORY_SEPARATOR;
        foreach ($finder as $file) {
            $targetFile = $destinationPath . $file->getFilename();
            $this->filesystem->copy($file->getRealPath(), $targetFile);
        }

        $this->filesystem->copy(
            $this->getTemporaryPath(self::CACHE_FILE_NAME),
            $this->getTransferPath(self::CACHE_FILE_NAME),
        );
    }
}
