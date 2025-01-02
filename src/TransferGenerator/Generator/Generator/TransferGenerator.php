<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private GeneratorProcessorInterface $processor,
    ) {
    }

    public function getTransferGenerator(string $configPath): Generator
    {
        $generatorTransfer = $this->processor->preProcess($configPath);
        if (!$generatorTransfer->validator->isValid) {
            yield $generatorTransfer;

            return false;
        }

        $failedCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processor->process($definitionTransfer);
            $failedCount += (int)!$generatorTransfer->validator->isValid;

            yield $generatorTransfer;
        }

        $isSuccess = $definitionGenerator->getReturn() > 0 && $failedCount === 0;
        yield $isSuccess ? $this->processor->postProcessSuccess() : $this->processor->postProcessError();

        return $isSuccess;
    }
}
