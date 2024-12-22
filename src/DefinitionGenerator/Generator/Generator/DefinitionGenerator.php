<?php declare(strict_types = 1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Generator\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Generated\HelperFilesystemTransfer;
use Picamator\TransferObject\Generated\HelperTransfer;

readonly class DefinitionGenerator implements DefinitionGeneratorInterface
{
    public function __construct(
        private DefinitionBuilderInterface $builder,
        private DefinitionRenderInterface $render,
        private DefinitionFilesystemInterface $filesystem,
    ) {
    }

    public function generateDefinitions(HelperTransfer $helperTransfer): int
    {
        $count = 0;
        $filesystemTransfer = new HelperFilesystemTransfer();
        $filesystemTransfer->fileName = lcfirst($helperTransfer->content->className);
        $filesystemTransfer->definitionPath = $helperTransfer->definitionPath;

        $this->filesystem->deleteFile($filesystemTransfer);

        foreach ($this->builder->buildDefinitionContents($helperTransfer->content) as $contentTransfer) {
            $content = $this->render->renderDefinitionContent($contentTransfer);

            $filesystemTransfer->content = $content;
            $this->filesystem->appendFile($filesystemTransfer);

            $count++;
        }

        return $count;
    }
}
