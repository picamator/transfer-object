<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

use Generator;
use Picamator\TransferObject\Shared\Exception\FileReaderException;

readonly class FileReader implements FileReaderInterface
{
    public function readFile(string $filename): Generator
    {
        $count = 0;
        $file = $this->getFile($filename);

        while (($fileLine = $this->fgets($file)) !== false) {
            $fileLine = trim($fileLine);
            if ($fileLine === '') {
                continue;
            }

            $count++;

            yield $fileLine;
        }

        $this->assertEndOfFile($file, $filename, $count);
        $this->closeFile($file, $filename);

        return $count;
    }

    /**
     * @param resource $file
     *
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     */
    private function closeFile($file, string $filename): void
    {
        if ($this->fclose($file)) {
            return;
        }

        throw new FileReaderException(
            sprintf('Failed to close "%s" file.', $filename),
        );
    }

    /**
     * @param resource $file
     *
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     */
    private function assertEndOfFile($file, string $filename, int $fileLine): void
    {
        if ($this->feof($file)) {
            return;
        }

        $this->fclose($file);

        throw new FileReaderException(
            sprintf('Failed to read file "%s" line "%d".', $filename, $fileLine),
        );
    }

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     *
     * @return resource
     */
    private function getFile(string $filename)
    {
        $file = $this->fopen($filename);
        if ($file === false) {
            throw new FileReaderException(
                sprintf('Failed to open file "%s" for reading.', $filename),
            );
        }

        return $file;
    }

    /**
     * @return false|resource
     */
    protected function fopen(string $filename)
    {
        if (!file_exists($filename)) {
            return false;
        }

        return fopen($filename, 'r');
    }

    /**
     * @param resource $file
     */
    protected function fgets($file): false|string
    {
        return fgets($file);
    }

    /**
     * @param resource $file
     */
    protected function feof($file): bool
    {
        return feof($file);
    }

    /**
     * @param resource $file
     */
    protected function fclose($file): bool
    {
        return fclose($file);
    }
}
