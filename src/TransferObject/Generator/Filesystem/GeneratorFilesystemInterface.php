<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Filesystem;

interface GeneratorFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function createTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function rotateTempDir(): void;

    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function writeFile(string $className, string $content) : void;
}
