<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

use ArrayObject;
use Picamator\TransferObject\Shared\Exception\FileCacheReaderException;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;

readonly class FileCacheReader implements FileCacheReaderInterface
{
    public function __construct(private FileReaderInterface $fileReader)
    {
    }

    public function readFile(string $path): ArrayObject
    {
        if (!$this->fileExists($path)) {
            return new ArrayObject();
        }

        $content = [];
        foreach ($this->fileReader->readFile($path) as $line) {
            if ($line === '') {
                continue;
            }

            $content = array_merge($content, $this->parseLine($line));
        }

        return new ArrayObject($content);
    }

    /**
     * @return array<string, string>
     */
    private function parseLine(string $line): array
    {
        /** @var array<int, string> $parsedLine */
        $parsedLine = explode(',', $line);
        $parsedLineCount = count($parsedLine);

        if ($parsedLineCount === 2) {
            return [
                $parsedLine[0] => $parsedLine[1],
            ];
        }

        throw new FileCacheReaderException('CSV file contains invalid line.');
    }

    protected function fileExists(string $filename): bool
    {
        return file_exists($filename);
    }
}
