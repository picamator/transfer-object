<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

readonly class GeneratorFilesystem implements GeneratorFilesystemInterface
{
    private const string TEMPORARY_DIR = '_tmp';

    private const string FILE_EXTENSION = '.php';
    private const string FILE_NAME_PATTERN = '*Transfer.php';

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

    public function rotateTempDir(): void
    {
        $this->deleteOldFiles();
        $this->copyTempFiles();
        $this->deleteTempDir();
    }

    public function writeFile(string $className, string $content): void
    {
        $filePath = $this->getTemporaryPath() . DIRECTORY_SEPARATOR . $className . self::FILE_EXTENSION;
        if ($this->filesystem->exists($filePath)) {
            throw new TransferGeneratorException(
                sprintf('Cannot save file "%s". A file with the same name already exists.', $filePath),
            );
        }

        $this->filesystem->dumpFile($filePath, $content);
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     */
    private function deleteOldFiles(): void
    {
        $finder = $this->finder->findFilesInDirectoryExclude(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->config->getTransferPath(),
            exclude: self::TEMPORARY_DIR,
        );

        $this->filesystem->remove($finder);
    }

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     */
    private function copyTempFiles(): void
    {
        $finder = $this->finder->findFilesInDirectory(
            filePattern: self::FILE_NAME_PATTERN,
            dirName: $this->getTemporaryPath(),
        );

        $destinationPath = $this->config->getTransferPath() . DIRECTORY_SEPARATOR;
        foreach ($finder as $file) {
            $this->filesystem->copy($file->getRealPath(), $destinationPath . $file->getFilename());
        }
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     */
    private function getTemporaryPath(): string
    {
        return $this->config->getTransferPath() . DIRECTORY_SEPARATOR . self::TEMPORARY_DIR;
    }
}
