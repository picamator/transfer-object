<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

readonly class FileCacheAppender implements FileCacheAppenderInterface
{
    public function __construct(private FileAppenderInterface $fileAppender)
    {
    }

    public function appendToFile(string $filename, string $key, string $value): void
    {
        $content = $key . ',' . $value . PHP_EOL;
        $this->fileAppender->appendToFile($filename, $content);
    }

    public function closeFile(string $filename): void
    {
        $this->fileAppender->closeFile($filename);
    }
}
