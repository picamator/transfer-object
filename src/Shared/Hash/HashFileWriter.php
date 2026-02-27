<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Hash;

use ArrayObject;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;

readonly class HashFileWriter implements HashFileWriterInterface
{
    public function __construct(private FilesystemInterface $filesystem)
    {
    }

    public function writeFile(string $filename, ArrayObject $data): void
    {
        $content = $this->renderContent($data);
        $this->filesystem->dumpFile($filename, $content);
    }

    /**
     * @param \ArrayObject<string, string> $data
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    private function renderContent(ArrayObject $data): string
    {
        $content = '';
        foreach ($data as $key => $value) {
            $content .= <<<CONTENT
$key,$value

CONTENT;
        }

        return rtrim($content, PHP_EOL);
    }
}
