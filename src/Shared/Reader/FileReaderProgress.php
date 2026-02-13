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
        $totalBytes = $this->getTotalBytes($filename);
        $progressTransfer = $this->createProgressTransfer($totalBytes);

        $contentIterator = $this->fileReader->readFile($filename);
        foreach ($contentIterator as $content) {
            $progressTransfer->content = $content;
            $progressTransfer->progressBytes += strlen($content);

            yield $progressTransfer;
        }
    }

    private function createProgressTransfer(int $totalBytes): FileReaderProgressTransfer
    {
        $progressTransfer = new FileReaderProgressTransfer();
        $progressTransfer->totalBytes = $totalBytes;
        $progressTransfer->progressBytes = 0;

        return $progressTransfer;
    }

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     */
    private function getTotalBytes(string $filename): int
    {
        if (!$this->fileExists($filename)) {
            throw new FileReaderException(
                sprintf('File "%s" does not exist.', $filename),
            );
        }

        $fileSize = $this->filesize($filename);
        if ($fileSize === 0) {
            throw new FileReaderException(
                sprintf('File "%s" is empty.', $filename),
            );
        }

        if ($fileSize === false) {
            throw new FileReaderException(
                sprintf(
                    'Failed to get size for file "%s". Error: "%s".',
                    $filename,
                    error_get_last()['message'] ?? 'Unknown error.',
                ),
            );
        }

        return $fileSize;
    }

    protected function filesize(string $filename): int|false
    {
        return @filesize($filename);
    }

    protected function fileExists(string $filename): bool
    {
        return file_exists($filename);
    }
}
