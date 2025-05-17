<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private TransferGeneratorBuilderInterface $builder,
        private GeneratorProcessorInterface $processor,
    ) {
    }

    public function generateTransfers(string $configPath): Generator
    {
        $generatorTransfer = $this->handlePreProcess($configPath);

        yield $generatorTransfer;

        if ($generatorTransfer->validator->isValid === false) {
            return false;
        }

        $failedCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processor->process($definitionTransfer);
            if (!$generatorTransfer->validator->isValid) {
                $failedCount++;
            }

            yield $generatorTransfer;
        }

        $isSuccess = $definitionGenerator->getReturn() > 0 && $failedCount === 0;

        yield $this->handlePostProcess($isSuccess);

        return $isSuccess;
    }

    private function handlePostProcess(bool $isSuccess): TransferGeneratorTransfer
    {
        if ($isSuccess) {
            return $this->processor->postProcessSuccess();
        }

        return $this->processor->postProcessError();
    }

    private function handlePreProcess(string $configPath): TransferGeneratorTransfer
    {
        $generatorTransfer = $this->processor->preProcess($configPath);
        if ($generatorTransfer->validator->isValid) {
            return $this->builder->createSuccessGeneratorTransfer();
        }

        return $generatorTransfer;
    }
}
