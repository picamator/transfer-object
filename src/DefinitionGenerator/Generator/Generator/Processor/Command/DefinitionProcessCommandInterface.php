<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionProcessCommandInterface
{
    public function process(
        DefinitionGeneratorTransfer $generatorTransfer,
        DefinitionFilesystemTransfer $filesystemTransfer,
    ): int;
}
