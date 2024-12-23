<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

interface GeneratorFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function createTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     */
    public function rotateTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function writeFile(string $className, string $content) : void;
}
