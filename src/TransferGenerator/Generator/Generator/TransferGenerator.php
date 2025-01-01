<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Throwable;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private GeneratorProcessorInterface $processor,
    ) {
    }

    public function getTransferGenerator(): Generator
    {
        $this->processor->preProcess();

        $failCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processor->process($definitionTransfer);
            $failCount += (int)!$generatorTransfer->validator?->isValid;

            try {
                yield $generatorTransfer;
            } catch (Throwable $e) {
                $this->processor->postProcessError();

                return false;
            }
        }

        $isSuccess = $definitionGenerator->getReturn() > 0 && $failCount === 0;
        $this->postProcess($isSuccess);

        return $isSuccess;
    }

    private function postProcess(bool $isSuccess): void
    {
        if ($isSuccess) {
            $this->processor->postProcessSuccess();

            return;
        }

        $this->processor->postProcessError();
    }
}
