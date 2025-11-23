<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Shared\Exception\JsonReaderException;
use Throwable;

readonly class JsonReader implements JsonReaderInterface
{
    public function __construct(
        private FilesystemInterface $filesystem,
    ) {
    }

    public function getJsonContent(string $path): array
    {
        try {
            $content = $this->filesystem->readFile($path);

            /** @var array<string,mixed> $jsonContent */
            $jsonContent = json_decode($content, associative: true, flags: JSON_THROW_ON_ERROR);

            return $jsonContent;
        } catch (Throwable $e) {
            throw new JsonReaderException($e->getMessage(), previous: $e);
        }
    }
}
