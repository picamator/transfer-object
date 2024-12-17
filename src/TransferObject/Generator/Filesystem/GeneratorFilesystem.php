<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Filesystem;

use Picamator\TransferObject\Config\Container\ConfigInterface;
use Picamator\TransferObject\Exception\GeneratorTransferException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Throwable;

readonly class GeneratorFilesystem implements GeneratorFilesystemInterface
{
    private const string TEMPORARY_DIR = '_tmp';

    private const string FILE_NAME_TEMPLATE = '%sTransfer.php';
    private const string FILE_NAME_PATTERN = '*Transfer.php';

    public function __construct(
        private Filesystem $filesystem,
        private Finder $finder,
        private ConfigInterface $config,
    ) {
    }

    public function createTempDir(): void
    {
        $temporaryPath = $this->getTemporaryPath();

        try {
            $this->deleteTempDir();
            $this->filesystem->mkdir($temporaryPath);
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf('Cannot create temporary directory "%s".', $temporaryPath),
                previous: $e,
            );
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
        $filePath = $this->getTemporaryPath() . DIRECTORY_SEPARATOR . sprintf(self::FILE_NAME_TEMPLATE, $className);
        if ($this->filesystem->exists($filePath)) {
            throw new GeneratorTransferException(
                sprintf('Cannot save file "%s". File with the same name already exit.', $filePath),
            );
        }

        try {
            $this->filesystem->dumpFile($filePath, $content);
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf('Cannot write file "%s".', $filePath),
                previous: $e,
            );
        }
    }

    private function deleteOldFiles(): void
    {
        try {
            $finder = $this->finder
                ->name(self::FILE_NAME_PATTERN)
                ->in($this->config->getTransferPath())
                ->exclude(self::TEMPORARY_DIR)
                ->files();

            $this->filesystem->remove($finder);
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf(
                    'Cannot delete previously generated files.',
                ),
                previous: $e,
            );
        }
    }

    private function copyTempFiles(): void
    {
        try {
            $finder = $this->finder
                ->name(self::FILE_NAME_PATTERN)
                ->in($this->getTemporaryPath())
                ->files();

            $destinationPath = $this->config->getTransferPath() . DIRECTORY_SEPARATOR;
            foreach ($finder as $file) {
                $this->filesystem->copy($file->getRealPath(), $destinationPath. $file->getFilename());
            }
        } catch (Throwable $e) {
            throw new GeneratorTransferException('Cannot copy generated files.', previous: $e);
        }
    }

    private function deleteTempDir(): void
    {
        $temporaryPath = $this->getTemporaryPath();

        try {
            if ($this->filesystem->exists($temporaryPath)) {
                $this->filesystem->remove($temporaryPath);
            }
        } catch (Throwable $e) {
            throw new GeneratorTransferException(
                sprintf('Cannot delete temporary directory "%s".', $temporaryPath),
                previous: $e,
            );
        }
    }

    private function getTemporaryPath(): string
    {
        return $this->config->getTransferPath() . DIRECTORY_SEPARATOR . self::TEMPORARY_DIR;
    }
}
