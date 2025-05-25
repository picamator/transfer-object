<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorProcessorInterface
{
    public function preProcess(DefinitionFilesystemTransfer $filesystemTransfer): void;

    public function process(
        DefinitionGeneratorTransfer $generatorTransfer,
        DefinitionFilesystemTransfer $filesystemTransfer,
    ): int;

    public function postProcess(DefinitionFilesystemTransfer $filesystemTransfer): void;
}
