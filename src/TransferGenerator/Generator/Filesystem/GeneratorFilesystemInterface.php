<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use ArrayObject;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;

interface GeneratorFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function createTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function deleteTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function writeTempFile(TransferGeneratorContentTransfer $contentTransfer): void;

    /**
     * @param \ArrayObject<int, string> $toCopyClassNames
     * @param \ArrayObject<int, string> $toDeleteClassNames
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    public function rotateFiles(ArrayObject $toCopyClassNames, ArrayObject $toDeleteClassNames): void;
}
