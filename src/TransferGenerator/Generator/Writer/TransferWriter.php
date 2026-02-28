<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Writer;

use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;
use Picamator\TransferObject\Generated\TransferHashTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Reader\TransferHashReaderInterface;

readonly class TransferWriter implements TransferWriterInterface
{
    public function __construct(
        private TransferHashReaderInterface $hashReader,
        private GeneratorFilesystemInterface $filesystem,
        private readonly ConfigInterface $config,
    ) {
    }

    public function writeFile(TransferGeneratorContentTransfer $contentTransfer): void
    {
        $hashTransfer = $this->hashReader->readHashFile();
        $hashTransfer->actualHashes[$contentTransfer->className] = $contentTransfer->hash;

        if ($this->config->getIsCacheEnabled() && !$this->isFileModified($contentTransfer, $hashTransfer)) {
            return;
        }

        $hashTransfer->toCopyClassNames[] = $contentTransfer->className;

        $this->filesystem->writeTempFile($contentTransfer);
    }

    private function isFileModified(
        TransferGeneratorContentTransfer $contentTransfer,
        TransferHashTransfer $hashTransfer,
    ): bool {
        $previousHash = $hashTransfer->hashes[$contentTransfer->className] ?? null;

        return $previousHash === null
            || !hash_equals(known_string: $contentTransfer->hash, user_string: $previousHash);
    }
}
