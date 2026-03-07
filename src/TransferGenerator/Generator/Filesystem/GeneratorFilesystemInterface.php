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
     */
    public function writeTempFile(TransferGeneratorContentTransfer $contentTransfer): void;

    /**
     * @param \ArrayObject<int, string> $classNames
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function renameTempFiles(ArrayObject $classNames): void;

    /**
     * @param \ArrayObject<int, string> $classNames
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function deleteFiles(ArrayObject $classNames): void;
}
