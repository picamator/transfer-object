<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Filesystem;

use Picamator\TransferObject\Exception\GeneratorTransferException;
use Picamator\TransferObject\Generator\Enum\TransferEnum;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use Throwable;

readonly class GeneratedFilesystem implements GeneratedFilesystemInterface
{
    private const string TEMPORARY_DIR = '_tmp';

    private const string FILE_EXTENSIONS = TransferEnum::FILE_EXTENSIONS->value;
    private const string FILE_NAME_PATTERN = TransferEnum::FILE_NAME_PATTERN->value;

    public function __construct(
        private Filesystem $filesystem,
        private Finder $finder,
        private ConfigTransfer $configTransfer,
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
        $filePath = $this->getTemporaryPath() . DIRECTORY_SEPARATOR . $className . static::FILE_EXTENSIONS;

        try {
            $this->filesystem->appendToFile($filePath, $content);
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
                ->name(static::FILE_NAME_PATTERN)
                ->in($this->configTransfer->generatedPath->path)
                ->exclude(static::TEMPORARY_DIR)
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
                ->name(static::FILE_NAME_PATTERN)
                ->in($this->getTemporaryPath())
                ->files();

            $destinationPath = $this->configTransfer->generatedPath->path . DIRECTORY_SEPARATOR;
            foreach ($finder as $file) {
                $this->filesystem->copy($file->getRealPath(), $destinationPath. $file->getFilename());
            }
        } catch (Throwable $e) {
            throw new GeneratorTransferException('Cannot copy generated files.', previous: $e);
        }
    }

    public function deleteTempDir(): void
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
        return $this->configTransfer->generatedPath->path . DIRECTORY_SEPARATOR . static::TEMPORARY_DIR;
    }
}
