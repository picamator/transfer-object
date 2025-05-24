<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Workflow;

use Generator;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;

readonly class TransferGeneratorWorkflow implements TransferGeneratorWorkflowInterface
{
    public function __construct(
        private GeneratorProcessorInterface $processor,
    ) {
    }

    public function generateTransfers(string $configPath): Generator
    {
        $generatorTransfer = $this->processConfig($configPath);

        yield $generatorTransfer;

        if (!$this->isValidTransfer($generatorTransfer)) {
            return false;
        }

        $transferGenerator = $this->processTransfers();

        yield from $transferGenerator;

        /** @var bool $isSuccessful */
        $isSuccessful = $transferGenerator->getReturn();

        yield $this->postProcessTransfers($isSuccessful);

        return $isSuccessful;
    }

    private function postProcessTransfers(bool $isSuccessful): TransferGeneratorTransfer
    {
        return $this->processor->postProcess($isSuccessful);
    }

    /**
     * @return Generator<int,TransferGeneratorTransfer>
     */
    private function processTransfers(): Generator
    {
        return $this->processor->process();
    }


    private function processConfig(string $configPath): TransferGeneratorTransfer
    {
        return $this->processor->preProcess($configPath);
    }

    private function isValidTransfer(TransferGeneratorTransfer $generatorTransfer): bool
    {
        return $generatorTransfer->validator->isValid;
    }
}
