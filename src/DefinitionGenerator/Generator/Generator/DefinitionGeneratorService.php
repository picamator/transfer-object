<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Builder\FilesystemBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\DefinitionGeneratorProcessorInterface;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionGeneratorService implements DefinitionGeneratorServiceInterface
{
    public function __construct(
        private FilesystemBuilderInterface $builder,
        private DefinitionGeneratorProcessorInterface $processor,
    ) {
    }

    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        $filesystemTransfer = $this->builder->createFilesystemTransfer($generatorTransfer);

        try {
            $this->processor->preProcess($filesystemTransfer);
            $result = $this->processor->process($generatorTransfer, $filesystemTransfer);
        } finally {
            $this->processor->postProcess($filesystemTransfer);
        }

        return $result;
    }
}
