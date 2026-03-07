<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Reader;

use Picamator\TransferObject\Generated\TransferHashTransfer;
use Picamator\TransferObject\Shared\Hash\HashFileReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;

class TransferHashReader implements TransferHashReaderInterface
{
    private TransferHashTransfer $hashTransfer;

    public function __construct(
        private readonly HashFileReaderInterface $fileReader,
        private readonly ConfigInterface $config,
    ) {
    }

    public function readHashFile(): TransferHashTransfer
    {
        if (!isset($this->hashTransfer) || $this->hashTransfer->configUuid !== $this->config->getUuid()) {
            $this->reloadHashFileCache();
        }

        return $this->hashTransfer;
    }

    private function reloadHashFileCache(): void
    {
        $filePath = $this->getFilePath();
        $hashes = $this->fileReader->readFile($filePath);

        $this->hashTransfer = new TransferHashTransfer([
            TransferHashTransfer::HASHES_PROP => $hashes,
            TransferHashTransfer::CONFIG_UUID_PROP => $this->config->getUuid(),
        ]);
    }

    private function getFilePath(): string
    {
        return $this->config->getTransferPath() . DIRECTORY_SEPARATOR . $this->config->getHashFileName();
    }
}
