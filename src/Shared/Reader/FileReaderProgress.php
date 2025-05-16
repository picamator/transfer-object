<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

use Generator;
use Picamator\TransferObject\Generated\FileReaderProgressTransfer;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;

readonly class FileReaderProgress implements FileReaderProgressInterface
{
    public function __construct(private FileReaderInterface $fileReader)
    {
    }

    public function readFile(string $filename): Generator
    {
        $contentIterator = $this->fileReader->readFile($filename);

        $progressTransfer = new FileReaderProgressTransfer();
        $progressTransfer->totalBytes = $this->filesize($filename);
        $progressTransfer->progressBytes = 0;

        foreach ($contentIterator as $content) {
            $progressTransfer->content = $content;
            $progressTransfer->progressBytes += strlen($content);

            yield $progressTransfer;
        }
    }

    protected function filesize(string $filename): int
    {
        $fileSize = filesize($filename);

        return $fileSize === false ? 0 : $fileSize;
    }
}
