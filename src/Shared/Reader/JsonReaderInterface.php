<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

interface JsonReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\JsonReaderException
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     *
     * @return array<string,mixed>
     */
    public function getJsonContent(string $path): array;
}
