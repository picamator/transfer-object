<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Definition;

use Picamator\TransferObject\Helper\Filesystem\HelperFilesystemInterface;
use Picamator\TransferObject\Helper\Reader\HelperReaderInterface;
use Picamator\TransferObject\Helper\Render\HelperRenderInterface;
use Picamator\TransferObject\Transfer\Generated\HelperFilesystemTransfer;
use Picamator\TransferObject\Transfer\Generated\HelperTransfer;

readonly class DefinitionGenerator implements DefinitionGeneratorInterface
{
    public function __construct(
        private HelperReaderInterface $reader,
        private HelperRenderInterface $render,
        private HelperFilesystemInterface $filesystem,
    ) {
    }

    public function generateDefinitions(HelperTransfer $helperTransfer): int
    {
        $count = 0;
        $filesystemTransfer = new HelperFilesystemTransfer();
        $filesystemTransfer->fileName = $helperTransfer->content->className;
        $filesystemTransfer->definitionPath = $helperTransfer->definitionPath;

        $this->filesystem->deleteFile($filesystemTransfer);

        foreach ($this->reader->getDefinitionContents($helperTransfer->content) as $contentTransfer) {
            $content = $this->render->renderDefinitionContent($contentTransfer);

            $filesystemTransfer->content = $content;
            $this->filesystem->appendFile($filesystemTransfer);

            $count++;
        }

        return $count;
    }
}
