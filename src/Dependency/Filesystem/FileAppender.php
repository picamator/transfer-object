<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Filesystem;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;

class FileAppender implements FileAppenderInterface
{
    /**
     * @var array<string,resource>
     */
    private static array $files;

    public function appendToFile(string $filename, string $content): void
    {
        $file = $this->getFile($filename);
        $writeResult = fwrite($file, $content);

        if ($writeResult === false) {
            throw new FilesystemException(
                sprintf('Failed to write content "%s" into the file "%s".', $content, $filename),
            );
        }
    }

    /**
     * @return resource
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    private function getFile(string $filename)
    {
        if (isset(self::$files[$filename])) {
            return self::$files[$filename];
        }

        $file = fopen($filename, 'a');
        if ($file === false) {
            throw new FilesystemException(
                sprintf('Failed to open file "%s" for writing.', $filename),
            );
        }

        return self::$files[$filename] = $file;
    }

    public function __destruct()
    {
        if (!isset(self::$files)) {
            return;
        }

        foreach (self::$files as $file) {
            fclose($file);
        }
    }
}
