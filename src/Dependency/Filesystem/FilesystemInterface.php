<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Filesystem;

interface FilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function copy(string $originFile, string $targetFile): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function rename(string $origin, string $target, bool $overwrite = false): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function mkdir(string $dir): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function exists(string $file): bool;

    /**
     * @param string|iterable<string,mixed> $files
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function remove(string|iterable $files): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function dumpFile(string $filename, string $content): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function readFile(string $filename): string;
}
