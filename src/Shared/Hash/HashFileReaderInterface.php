<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Hash;

interface HashFileReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     *
     * @return array<string, string>
     */
    public function readFile(string $path): array;
}
