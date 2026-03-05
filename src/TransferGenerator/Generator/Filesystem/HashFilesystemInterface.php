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
    public function writeHashTmpFile(ArrayObject $hashes): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function renameHashTmpFile(): void;
}
