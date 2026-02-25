<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

interface FileCacheAppenderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileAppenderException
     */
    public function appendToFile(string $filename, string $key, string $value): void;

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileAppenderException
     */
    public function closeFile(string $filename): void;
}
