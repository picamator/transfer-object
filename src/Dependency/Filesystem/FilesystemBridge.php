<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Filesystem;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Symfony\Component\Filesystem\Filesystem;
use Throwable;

readonly final class FilesystemBridge implements FilesystemInterface
{
    public function __construct(private Filesystem $filesystem)
    {
    }

    public function copy(string $originFile, string $targetFile): void
    {
        try {
            $this->filesystem->copy($originFile, $targetFile);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf(
                    'Fail to copy "%s" to "%s", error "%s".',
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
                sprintf('Fail to create directory "%s", error "%s".', $dir, $e->getMessage()),
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
                sprintf('Fail to check if file "%s" exists, error "%s".', $file, $e->getMessage()),
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
                sprintf('Fail to delete file(s) "%s", error "%s".', $filePlaceholder, $e->getMessage()),
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
                    'Fail to write content "%s" to file "%s", error "%s".',
                    $content,
                    $filename,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
    }

    public function appendToFile(string $filename, string $content): void
    {
        try {
            $this->filesystem->appendToFile($filename, $content);
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf(
                    'Fail to append content "%s" to file "%s", error "%s".',
                    $content,
                    $filename,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
    }
}
