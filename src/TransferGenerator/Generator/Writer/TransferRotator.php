<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Writer;

use ArrayObject;
use Picamator\TransferObject\Generated\TransferHashTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\HashFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Reader\TransferHashReaderInterface;

readonly class TransferRotator implements TransferRotatorInterface
{
    public function __construct(
        private TransferHashReaderInterface $hashReader,
        private HashFilesystemInterface $hashFilesystem,
        private GeneratorFilesystemInterface $filesystem,
        private TransferLockerInterface $transferLocker,
    ) {
    }

    public function rotateFiles(): void
    {
        $hashTransfer = $this->hashReader->readHashFile();
        $toDelete = $this->getToDelete($hashTransfer);

        $isToDelete = $toDelete->count() > 0;
        $isToCopy = $hashTransfer->toCopyClassNames->count() > 0;

        if (!$isToDelete && !$isToCopy) {
            return;
        }

        $this->transferLocker->acquireLock();

        try {
            if ($isToDelete) {
                $this->filesystem->deleteFiles($toDelete);
            }

            if ($isToCopy) {
                $this->filesystem->renameTempFiles($hashTransfer->toCopyClassNames);
            }

            $this->rotateHashFile($hashTransfer->actualHashes);
        } finally {
            $this->transferLocker->releaseLock();
        }
    }

    /**
     * @param ArrayObject<string, string> $actualHashes
     */
    private function rotateHashFile(ArrayObject $actualHashes): void
    {
        $this->hashFilesystem->writeHashTmpFile($actualHashes);
        $this->hashFilesystem->renameHashTmpFile();
    }

    /**
     * @return \ArrayObject<int, string>
     */
    private function getToDelete(TransferHashTransfer $hashTransfer): ArrayObject
    {
        /** @var \ArrayObject<int, string> $classesNames */
        $classesNames = new ArrayObject();
        $hashesIterator = $hashTransfer->hashes->getIterator();

        while ($hashesIterator->valid()) {
            $className = $hashesIterator->key();
            $hashesIterator->next();

            if (isset($hashTransfer->actualHashes[$className])) {
                continue;
            }

            $classesNames[] = basename($className);
        }

        return $classesNames;
    }
}
