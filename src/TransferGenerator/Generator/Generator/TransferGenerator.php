<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Throwable;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private ConfigLoaderInterface $configLoader,
        private DefinitionReaderInterface $definitionReader,
        private GeneratorProcessorInterface $processor,
    ) {
    }

    public function getTransferGenerator(string $configPath): Generator
    {
        try {
            yield $this->preProcess($configPath);
        } catch (Throwable) {
            return false;
        }

        $failCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionTransfer) {
            $generatorTransfer = $this->processor->process($definitionTransfer);
            $failCount += (int)!$generatorTransfer->validator?->isValid;

            try {
                yield $generatorTransfer;
            } catch (Throwable) {
                yield $this->processor->postProcessError();

                return false;
            }
        }

        $isSuccess = $definitionGenerator->getReturn() > 0 && $failCount === 0;
        yield $this->postProcess($isSuccess);

        return $isSuccess;
    }

    private function postProcess(bool $isSuccess): TransferGeneratorTransfer
    {
        if ($isSuccess) {
            return $this->processor->postProcessSuccess();
        }

        return $this->processor->postProcessError();
    }

    private function preProcess(string $configPath): TransferGeneratorTransfer
    {
        $configTransfer = $this->configLoader->loadConfig($configPath);

        if ($configTransfer->validator->isValid) {
            return $this->processor->preProcess();
        }

        $generatorTransfer = new TransferGeneratorTransfer();
        $generatorTransfer->validator = new DefinitionValidatorTransfer();
        $generatorTransfer->validator->isValid = false;
        $generatorTransfer->validator->errorMessages = $configTransfer->validator->errorMessages;

        return $generatorTransfer;
    }
}
