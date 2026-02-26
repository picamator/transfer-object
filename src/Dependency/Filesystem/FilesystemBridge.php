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
            // @codeCoverageIgnoreStart
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
        // @codeCoverageIgnoreEnd
    }

    public function rename(string $origin, string $target, bool $overwrite = false): void
    {
        try {
            $this->filesystem->rename($origin, $target, $overwrite);
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf(
                    'Failed to rename "%s" to "%s". Error: "%s".',
                    $origin,
                    $target,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
    }

    public function mkdir(string $dir): void
    {
        try {
            $this->filesystem->mkdir($dir);
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf('Failed to create directory "%s". Error: "%s".', $dir, $e->getMessage()),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
    }

    public function exists(string $file): bool
    {
        try {
            return $this->filesystem->exists($file);
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf('Failed to check if file "%s" exists. Error: "%s".', $file, $e->getMessage()),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
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
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            $filePlaceholder = is_string($files) ? $files : var_export($files, true);

            throw new FilesystemException(
                sprintf('Failed to delete file(s) "%s". Error: "%s".', $filePlaceholder, $e->getMessage()),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
    }

    public function dumpFile(string $filename, string $content): void
    {
        try {
            $this->filesystem->dumpFile($filename, $content);
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            $content = substr($content, 0, 100) . '...';

            throw new FilesystemException(
                sprintf(
                    'Failed to write content to file "%s". Content: "%s". Error: "%s".',
                    $filename,
                    $content,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
    }

    public function readFile(string $filename): string
    {
        try {
            return $this->filesystem->readFile($filename);
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            throw new FilesystemException(
                sprintf('Failed to read file "%s". Error: "%s".', $filename, $e->getMessage()),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
    }
}
