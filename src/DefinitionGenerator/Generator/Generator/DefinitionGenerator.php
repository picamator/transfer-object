<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionGenerator implements DefinitionGeneratorInterface
{
    public function __construct(
        private DefinitionBuilderInterface $builder,
        private DefinitionRenderInterface $render,
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function generateDefinitions(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        $count = 0;
        $filesystemTransfer = new DefinitionFilesystemTransfer();
        $filesystemTransfer->fileName = lcfirst($generatorTransfer->content->className);
        $filesystemTransfer->definitionPath = $generatorTransfer->definitionPath;

        $this->filesystem->deleteFile($filesystemTransfer);

        foreach ($this->builder->buildDefinitionContents($generatorTransfer->content) as $contentTransfer) {
            $content = $this->render->renderDefinitionContent($contentTransfer);

            $filesystemTransfer->content = $content;
            $this->filesystem->appendFile($filesystemTransfer);

            $count++;
        }

        return $count;
    }
}
