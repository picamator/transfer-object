<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

interface FileAppenderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileAppenderException
     */
    public function appendToFile(string $filename, string $content): void;
}
