<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor;

use Generator;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\BulkProcessCommandInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommandInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PreProcessCommandInterface;

readonly class GeneratorProcessor implements GeneratorProcessorInterface
{
    public function __construct(
        private PreProcessCommandInterface $preProcessCommand,
        private BulkProcessCommandInterface $bulkProcessCommand,
        private PostProcessCommandInterface $postProcessCommand,
    ) {
    }

    public function preProcess(string $configPath): TransferGeneratorTransfer
    {
        return $this->preProcessCommand->preProcess($configPath);
    }

    public function process(): Generator
    {
        return $this->bulkProcessCommand->process();
    }

    public function postProcess(bool $isSuccessful): TransferGeneratorTransfer
    {
        return $this->postProcessCommand->postProcess($isSuccessful);
    }
}
