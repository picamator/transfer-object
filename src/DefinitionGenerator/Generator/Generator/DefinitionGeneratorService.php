<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionGeneratorService implements DefinitionGeneratorServiceInterface
{
    public function __construct(
        private DefinitionBuilderInterface $builder,
        private DefinitionRenderInterface $render,
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        $count = 0;
        $filesystemTransfer = $this->createFilesystemTransfer($generatorTransfer);
        $this->filesystem->deleteFile($filesystemTransfer);

        foreach ($this->builder->createDefinitionContents($generatorTransfer->content) as $contentTransfer) {
            $filesystemTransfer->content = $this->render->renderDefinitionContent($contentTransfer);
            $this->filesystem->appendFile($filesystemTransfer);

            $count++;
        }

        return $count;
    }

    private function createFilesystemTransfer(
        DefinitionGeneratorTransfer $generatorTransfer,
    ): DefinitionFilesystemTransfer {
        $filesystemTransfer = new DefinitionFilesystemTransfer();
        $filesystemTransfer->fileName = lcfirst($generatorTransfer->content->className);
        $filesystemTransfer->definitionPath = $generatorTransfer->definitionPath;

        return $filesystemTransfer;
    }
}
