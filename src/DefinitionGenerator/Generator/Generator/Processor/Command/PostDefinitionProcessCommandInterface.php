<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;

interface PostDefinitionProcessCommandInterface
{
    public function postProcess(DefinitionFilesystemTransfer $filesystemTransfer): void;
}
