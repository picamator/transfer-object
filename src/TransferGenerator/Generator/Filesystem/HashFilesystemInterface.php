<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use ArrayObject;

interface HashFilesystemInterface
{
    /**
     * @param \ArrayObject<string, string> $hashes
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function rotateHashFile(ArrayObject $hashes): void;
}
