<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

use Generator;
use Picamator\TransferObject\Generated\FileReaderProgressTransfer;
use Picamator\TransferObject\Shared\Exception\FileReaderException;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;

readonly class FileReaderProgress implements FileReaderProgressInterface
{
    public function __construct(
        private FileReaderInterface $fileReader,
    ) {
    }

    public function readFile(string $filename): Generator
    {
        $progressTransfer = $this->createProgressTransfer($filename);
        if ($progressTransfer->totalBytes === 0) {
            throw new FileReaderException(
                sprintf('File "%s" is empty.', $filename),
            );
        }

        $contentIterator = $this->fileReader->readFile($filename);
        foreach ($contentIterator as $content) {
            $progressTransfer->content = $content;
            $progressTransfer->progressBytes += strlen($content);

            yield $progressTransfer;
        }
    }

    private function createProgressTransfer(string $filename): FileReaderProgressTransfer
    {
        $filesize = (int)$this->filesize($filename);

        $progressTransfer = new FileReaderProgressTransfer();
        $progressTransfer->totalBytes = $filesize;
        $progressTransfer->progressBytes = 0;

        return $progressTransfer;
    }

    protected function filesize(string $filename): int|false
    {
        if (!file_exists($filename)) {
            return false;
        }

        return filesize($filename);
    }
}
