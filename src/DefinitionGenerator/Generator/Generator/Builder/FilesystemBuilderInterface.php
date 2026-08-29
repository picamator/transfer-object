<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface FilesystemBuilderInterface
{
    public function createFilesystemTransfer(
        DefinitionGeneratorTransfer $generatorTransfer,
    ): DefinitionFilesystemTransfer;
}
