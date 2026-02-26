<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use ArrayObject;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Shared\Hash\HashFileWriterInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;

readonly class HashFilesystem implements HashFilesystemInterface
{
    use FilesystemTrait;

    public function __construct(
        private FilesystemInterface $filesystem,
        private HashFileWriterInterface $fileWriter,
        private ConfigInterface $config,
    ) {
    }

    public function rotateHashFile(ArrayObject $hashes): void
    {
        $this->writeHashTmpFile($hashes);
        $this->copyHashTmpFile();
        $this->deleteHashTmpFile();
    }

    private function copyHashTmpFile(): void
    {
        $fileName = $this->config->getHashFileName();

        $originalFile = $this->getTemporaryPath($fileName);
        $targetFile = $this->getTransferPath($fileName);

        $this->filesystem->copy($originalFile, $targetFile);
    }

    private function deleteHashTmpFile(): void
    {
        $filePath = $this->getTemporaryPath($this->config->getHashFileName());
        $this->filesystem->remove($filePath);
    }

    /**
     * @param \ArrayObject<string, string> $hashes
     */
    private function writeHashTmpFile(ArrayObject $hashes): void
    {
        $filePath = $this->getTemporaryPath($this->config->getHashFileName());
        $this->fileWriter->writeFile($filePath, $hashes);
    }
}
