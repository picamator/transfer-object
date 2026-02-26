<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Hash;

use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;

readonly class HashFileReader implements HashFileReaderInterface
{
    public function __construct(private FileReaderInterface $fileReader)
    {
    }

    public function readFile(string $path): array
    {
        if (!$this->fileExists($path)) {
            return [];
        }

        $content = [];
        foreach ($this->fileReader->readFile($path) as $line) {
            if ($line === '') {
                continue;
            }

            $content += $this->parseLine($line);
        }

        return $content;
    }

    /**
     * @return array<string, string>
     */
    private function parseLine(string $line): array
    {
        $separatorPos = strpos($line, ',');
        if ($separatorPos === false || $separatorPos === 0) {
            return [];
        }

        $className = substr($line, 0, $separatorPos)
            |>trim(...);

        /** @var string $className */
        $className = pathinfo($className, flags: PATHINFO_BASENAME);

        $hash = substr($line, $separatorPos + 1)
            |>trim(...);

        return [$className => $hash];
    }

    protected function fileExists(string $filename): bool
    {
        return file_exists($filename);
    }
}
