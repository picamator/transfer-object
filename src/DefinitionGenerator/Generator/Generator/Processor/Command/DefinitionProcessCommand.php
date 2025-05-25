<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionProcessCommand implements DefinitionProcessCommandInterface
{
    public function __construct(
        private DefinitionBuilderInterface $builder,
        private DefinitionRenderInterface $render,
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function process(
        DefinitionGeneratorTransfer $generatorTransfer,
        DefinitionFilesystemTransfer $filesystemTransfer,
    ): int {
        $count = 0;
        foreach ($this->builder->createDefinitionContents($generatorTransfer->content) as $contentTransfer) {
            $filesystemTransfer->content = $this->render->renderDefinitionContent($contentTransfer);
            $this->filesystem->appendFile($filesystemTransfer);

            $count++;
        }

        return $count;
    }
}
