<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionFilesystemTransfer;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionProcessCommand implements DefinitionProcessCommandInterface
{
    public function __construct(
        private DefinitionBuilderInterface $builder,
        private TemplateRenderInterface $render,
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function process(
        DefinitionGeneratorTransfer $generatorTransfer,
        DefinitionFilesystemTransfer $filesystemTransfer,
    ): int {
        $count = 0;
        foreach ($this->builder->createDefinitionContents($generatorTransfer->content) as $contentTransfer) {
            $content = $this->renderContent($contentTransfer);
            $this->appendContent($filesystemTransfer, $content);

            $count++;
        }

        return $count;
    }

    private function appendContent(DefinitionFilesystemTransfer $filesystemTransfer, string $content): void
    {
        $filesystemTransfer->content = $content;
        $this->filesystem->appendFile($filesystemTransfer);
    }

    private function renderContent(DefinitionContentTransfer $contentTransfer): string
    {
        return $this->render->renderContent($contentTransfer);
    }
}
