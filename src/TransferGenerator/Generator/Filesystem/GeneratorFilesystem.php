<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Config\Container\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Symfony\Component\Finder\Finder;

readonly class GeneratorFilesystem implements GeneratorFilesystemInterface
{
    private const string TEMPORARY_DIR = '_tmp';

    private const string FILE_NAME_TEMPLATE = '%sTransfer.php';
    private const string FILE_NAME_PATTERN = '*Transfer.php';

    public function __construct(
        private FilesystemInterface $filesystem,
        private Finder $finder,
        private ConfigInterface $config,
    ) {
    }

    public function createTempDir(): void
    {
        $temporaryPath = $this->getTemporaryPath();

        $this->deleteTempDir();
        $this->filesystem->mkdir($temporaryPath);
    }

    public function rotateTempDir(): void
    {
        $this->deleteOldFiles();
        $this->copyTempFiles();
        $this->deleteTempDir();
    }

    public function writeFile(string $className, string $content): void
    {
        $filePath = $this->getTemporaryPath() . DIRECTORY_SEPARATOR . sprintf(self::FILE_NAME_TEMPLATE, $className);
        if ($this->filesystem->exists($filePath)) {
            throw new TransferGeneratorException(
                sprintf('Cannot save file "%s". File with the same name already exit.', $filePath),
            );
        }

        $this->filesystem->dumpFile($filePath, $content);
    }

    private function deleteOldFiles(): void
    {
        $finder = $this->finder
            ->files()
            ->name(self::FILE_NAME_PATTERN)
            ->in($this->config->getTransferPath())
            ->exclude(self::TEMPORARY_DIR);

        $this->filesystem->remove($finder);
    }

    private function copyTempFiles(): void
    {
        $finder = $this->finder
            ->name(self::FILE_NAME_PATTERN)
            ->in($this->getTemporaryPath())
            ->files();

        $destinationPath = $this->config->getTransferPath() . DIRECTORY_SEPARATOR;
        foreach ($finder as $file) {
            $this->filesystem->copy($file->getRealPath(), $destinationPath. $file->getFilename());
        }
    }

    private function deleteTempDir(): void
    {
        $temporaryPath = $this->getTemporaryPath();
        if ($this->filesystem->exists($temporaryPath)) {
            $this->filesystem->remove($temporaryPath);
        }
    }

    private function getTemporaryPath(): string
    {
        return $this->config->getTransferPath() . DIRECTORY_SEPARATOR . self::TEMPORARY_DIR;
    }
}
