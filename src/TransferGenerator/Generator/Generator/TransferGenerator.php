<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;

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

        $failCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processor->generateTransfer($definitionTransfer);
            $failCount += (int)!$generatorTransfer->validator?->isValid;

            yield $generatorTransfer;
        }

        $isSuccess = $definitionGenerator->getReturn() > 0 && $failCount === 0;
        $this->processor->postGenerateTransfer($isSuccess);

        return $isSuccess;
    }

    public function getDefinitionFileCount(): int
    {
        return $this->definitionReader->getDefinitionFileCount();
    }
}
