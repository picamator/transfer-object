<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Filesystem;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

readonly final class FilesystemBridge implements FilesystemInterface
{
    public function __construct(
        private Filesystem $filesystem,
    ) {
    }

    public function copy(string $originFile, string $targetFile): void
    {
        try {
            $this->filesystem->copy($originFile, $targetFile);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf(
                    'Failed to copy "%s" to "%s". Error: "%s".',
                    $originFile,
                    $targetFile,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
    }

    public function mkdir(string $dir): void
    {
        try {
            $this->filesystem->mkdir($dir);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf('Failed to create directory "%s". Error: "%s".', $dir, $e->getMessage()),
                previous: $e,
            );
        }
    }

    public function exists(string $file): bool
    {
        try {
            return $this->filesystem->exists($file);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf('Failed to check if file "%s" exists. Error: "%s".', $file, $e->getMessage()),
                previous: $e,
            );
        }
    }

    /**
     * @param string|iterable<string,mixed> $files
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function remove(string|iterable $files): void
    {
        try {
            $this->filesystem->remove($files);
        } catch (Throwable $e) {
            $filePlaceholder = is_string($files) ? $files : var_export($files, true);

            throw new FilesystemException(
                sprintf('Failed to delete file(s) "%s". Error: "%s".', $filePlaceholder, $e->getMessage()),
                previous: $e,
            );
        }
    }

    public function dumpFile(string $filename, string $content): void
    {
        try {
            $this->filesystem->dumpFile($filename, $content);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf(
                    'Failed to write content to file "%s". Content: "%s". Error: "%s".',
                    $content,
                    $filename,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
    }

    public function readFile(string $filename): string
    {
        try {
            return $this->filesystem->readFile($filename);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf(
                    'Failed to read file "%s". Error: "%s".',
                    $filename,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
    }
}
