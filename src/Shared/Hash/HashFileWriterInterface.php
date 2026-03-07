<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Hash;

use ArrayObject;

interface HashFileWriterInterface
{
    /**
     * @param \ArrayObject<string, string> $data
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function writeFile(string $filename, ArrayObject $data): void;
}
