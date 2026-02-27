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
    ) {
    }

    public function rotateFiles(): void
    {
        $hashTransfer = $this->hashReader->readHashFile();
        $toDeleteClassNames = $this->getToDeleteClassNames($hashTransfer);

        if ($toDeleteClassNames->count() === 0 && $hashTransfer->toCopyClassNames->count() === 0) {
            $this->filesystem->deleteTempDir();
        }

        $this->filesystem->rotateFiles($hashTransfer->toCopyClassNames, $toDeleteClassNames);
        $this->hashFilesystem->rotateHashFile($hashTransfer->actualHashes);
    }

    /**
     * @return \ArrayObject<int, string>
     */
    private function getToDeleteClassNames(TransferHashTransfer $hashTransfer): ArrayObject
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

            /** @var string $className */
            $className = pathinfo($className, flags: PATHINFO_BASENAME);
            $classesNames[] = $className;
        }

        return $classesNames;
    }
}
