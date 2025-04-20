<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Filesystem;

interface FileAppenderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function appendToFile(string $filename, string $content): void;
}
