<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor;

// phpcs:disable Generic.Files.LineLength
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\DefinitionProcessCommandInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\PostDefinitionProcessCommandInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command\PreDefinitionProcessCommandInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionGeneratorProcessor implements DefinitionGeneratorProcessorInterface
{
    public function __construct(
        private PreDefinitionProcessCommandInterface $preProcessCommand,
        private DefinitionProcessCommandInterface $processCommand,
        private PostDefinitionProcessCommandInterface $postProcessCommand,
    ) {
    }

    public function preProcess(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $this->preProcessCommand->preProcess($filesystemTransfer);
    }

    public function process(
        DefinitionGeneratorTransfer $generatorTransfer,
        DefinitionFilesystemTransfer $filesystemTransfer,
    ): int {
        return $this->processCommand->process($generatorTransfer, $filesystemTransfer);
    }

    public function postProcess(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $this->postProcessCommand->postProcess($filesystemTransfer);
    }
}
