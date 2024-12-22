<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

interface GeneratorFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\GeneratorTransferException
     */
    public function createTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\GeneratorTransferException
     */
    public function rotateTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\GeneratorTransferException
     */
    public function writeFile(string $className, string $content) : void;
}
