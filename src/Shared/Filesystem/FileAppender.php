<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

use Picamator\TransferObject\Shared\Exception\FileAppenderException;

class FileAppender implements FileAppenderInterface
{
    /**
     * @var array<string,resource>
     */
    private array $fileCache = [];

    public function appendToFile(string $filename, string $content): void
    {
        $file = $this->getFile($filename);
        $writeResult = $this->fwrite($file, $content);

        if ($writeResult === false) {
            throw new FileAppenderException(
                sprintf('Failed to write content "%s" into the file "%s".', $content, $filename),
            );
        }
    }

    public function closeFile(string $filename): void
    {
        $file = $this->fileCache[$filename] ?? null;
        if ($file === null) {
            return;
        }

        $isClosed = $this->fclose($file);
        if ($isClosed === false) {
            throw new FileAppenderException(
                sprintf('Failed to close the file "%s".', $filename),
            );
        }

        unset($this->fileCache[$filename]);
    }

    /**
     * @return resource
     *
     * @throws \Picamator\TransferObject\Shared\Exception\FileAppenderException
     */
    private function getFile(string $filename)
    {
        if (isset($this->fileCache[$filename])) {
            return $this->fileCache[$filename];
        }

        $file = $this->fopen($filename);
        if ($file === false) {
            throw new FileAppenderException(
                sprintf('Failed to open file "%s" for writing.', $filename),
            );
        }

        return $this->fileCache[$filename] = $file;
    }

    /**
     * @param resource $file
     */
    protected function fwrite($file, string $content): false|int
    {
        return fwrite($file, $content);
    }

    /**
     * @return false|resource
     */
    protected function fopen(string $filename)
    {
        return fopen($filename, 'a');
    }

    /**
     * @param resource $file
     */
    protected function fclose($file): bool
    {
        return fclose($file);
    }
}
