<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;

readonly class PostDefinitionProcessCommand implements PostDefinitionProcessCommandInterface
{
    public function __construct(
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function postProcess(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $this->filesystem->closeFile($filesystemTransfer);
    }
}
