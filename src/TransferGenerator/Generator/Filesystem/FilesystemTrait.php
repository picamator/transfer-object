<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

trait FilesystemTrait
{
    private const string TEMPORARY_DIR = '_tmp';

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    final protected function getTransferPath(?string $filename = null): string
    {
        $path = $this->config->getTransferPath();
        if ($filename !== null) {
            $path .= DIRECTORY_SEPARATOR . $filename;
        }

        return $path;
    }

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     */
    final protected function getTemporaryPath(?string $filename = null): string
    {
        $path = $this->config->getTransferPath()
            . DIRECTORY_SEPARATOR
            . self::TEMPORARY_DIR
            . DIRECTORY_SEPARATOR
            . $this->config->getUuid();

        if ($filename !== null) {
            $path .= DIRECTORY_SEPARATOR . $filename;
        }

        return $path;
    }
}
