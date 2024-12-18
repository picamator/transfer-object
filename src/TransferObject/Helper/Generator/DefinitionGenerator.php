<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Generator;

use Picamator\TransferObject\Helper\Filesystem\DefinitionFilesystemInterface;
use Picamator\TransferObject\Helper\Builder\DefinitionBuilderInterface;
use Picamator\TransferObject\Helper\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Transfer\Generated\HelperFilesystemTransfer;
use Picamator\TransferObject\Transfer\Generated\HelperTransfer;

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
        $filesystemTransfer->fileName = $helperTransfer->content->className;
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
