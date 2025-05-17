<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Generator;
use Picamator\TransferObject\Shared\Reader\FileReaderProgressInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBulkBuilderInterface;
use Throwable;

readonly class TransferGeneratorBulkFiber implements TransferGeneratorBulkFiberInterface
{
    public function __construct(
        private FileReaderProgressInterface $fileReader,
        private TransferGeneratorBulkBuilderInterface $builder,
        private TransferGeneratorServiceInterface $transferGenerator,
    ) {
    }

    public function getTransferGeneratorFiber(): Fiber
    {
        /** @var \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer> $fiber */
        $fiber = new Fiber($this->getTransferFiberCallback(...));

        return $fiber;
    }

    private function getTransferFiberCallback(string $configListPath): bool
    {
        $progressIterator = $this->handlePreProcess($configListPath);
        if ($progressIterator === false) {
            return false;
        }

        return $this->handleProcess($progressIterator);
    }

    /**
     * @param \Generator<int, \Picamator\TransferObject\Generated\FileReaderProgressTransfer> $progressIterator
     */
    private function handleProcess(Generator $progressIterator): bool
    {
        try {
            /** @var \Picamator\TransferObject\Generated\FileReaderProgressTransfer $progressTransfer */
            foreach ($progressIterator as $progressTransfer) {
                $this->transferGenerator->generateTransfersOrFail($progressTransfer->content);
                $bulkTransfer = $this->builder->createSuccessBulkTransfer($progressTransfer);

                Fiber::suspend($bulkTransfer);
            }
        } catch (Throwable $e) {
            $bulkTransfer = $this->builder->createFailedBulkTransfer(
                $e->getMessage(),
                progressTransfer: $progressTransfer ?? null,
            );

            Fiber::suspend($bulkTransfer);

            return false;
        }

        return true;
    }

    /**
     * @return \Generator<int,\Picamator\TransferObject\Generated\FileReaderProgressTransfer>|false
     */
    private function handlePreProcess(string $configListPath): Generator|false
    {
        try {
            $progressIterator = $this->fileReader->readFile($configListPath);

            /** @var \Picamator\TransferObject\Generated\FileReaderProgressTransfer|null $progressTransfer */
            $progressTransfer = $progressIterator->current();
            $progressTransfer ??= $this->builder->createDefaultProgressTransfer();

            $bulkTransfer = $this->builder->createSuccessBulkTransfer($progressTransfer);

            Fiber::suspend($bulkTransfer);

            return $progressIterator;
        } catch (Throwable $e) {
            $bulkTransfer = $this->builder->createFailedBulkTransfer($e->getMessage());

            Fiber::suspend($bulkTransfer);

            return false;
        }
    }
}
