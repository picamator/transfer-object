<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Generator;
use Picamator\TransferObject\Command\Helper\ProgressBarInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private GeneratorProcessorInterface $processor,
    ) {
    }

    public function getTransferGenerator(): Generator
    {
        $this->processor->preGenerateTransfer();

        $validCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processor->generateTransfer($definitionTransfer);
            $validCount += (int)$generatorTransfer->validator?->isValid;

            yield $generatorTransfer;
        }

        $totalGenerated = $definitionGenerator->getReturn();
        $isSuccess = $totalGenerated !== 0 && $totalGenerated === $validCount;
        $this->processor->postGenerateTransfer($isSuccess);

        return $isSuccess;
    }

    /**
     * @throws \FiberError
     * @throws \Throwable
     */
    public function getTransferFiberCallback(ProgressBarInterface $progressBar): bool
    {
        $progressBar->progressStart($this->definitionReader->getDefinitionFileCount());
        $generatorIterator = $this->getTransferGenerator();

        $currentDefinitionFile = '';
        foreach ($generatorIterator as $generatorTransfer) {
            if ($currentDefinitionFile !== $generatorTransfer->fileName) {
                $currentDefinitionFile = $generatorTransfer->fileName;
                $progressBar->progressAdvance();
            }

            Fiber::suspend($generatorTransfer);
        }

        $progressBar->progressFinish();

        return $generatorIterator->getReturn();
    }

    /**
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateTransfers(): void
    {
        foreach ($this->getTransferGenerator() as $generatorTransfer) {
            if ($generatorTransfer->validator?->isValid === true) {
                continue;
            }

            $errorMessage = $generatorTransfer->validator?->errorMessages[0] ?? null;
            throw new TransferGeneratorException(
                sprintf(
                    'Failed generating Transfer Object "%s" based on definition file "%s". Error: "%s".',
                    $generatorTransfer->className,
                    $generatorTransfer->fileName,
                    $errorMessage?->errorMessage ?: '',
                ),
            );
        }
    }
}
