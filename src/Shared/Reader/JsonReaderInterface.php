<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

interface JsonReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\JsonReaderException
     *
     * @return array<string,mixed>
     */
    public function getJsonContent(string $path): array;
}
