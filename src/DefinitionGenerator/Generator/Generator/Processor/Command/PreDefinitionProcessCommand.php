<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;

readonly class PreDefinitionProcessCommand implements PreDefinitionProcessCommandInterface
{
    public function __construct(
        private TemplateRenderInterface $render,
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function preProcess(DefinitionFilesystemTransfer $filesystemTransfer): void
    {
        $this->filesystem->deleteFile($filesystemTransfer);
        $this->filesystem->createDir($filesystemTransfer);

        $filesystemTransfer->content = $this->render->renderSchema();
        $this->filesystem->appendFile($filesystemTransfer);
    }
}
