<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Fiber;
use Picamator\TransferObject\Generator\Filesystem\GeneratedFilesystemInterface;
use Picamator\TransferObject\Generator\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\Generator\Template\TemplateRenderInterface;
use Picamator\TransferObject\Generated\GeneratorTransfer;

readonly class GeneratorFiber implements GeneratorFiberInterface
{
    public function __construct(
        private DefinitionReaderInterface $reader,
        private TemplateRenderInterface $renderer,
        private GeneratedFilesystemInterface $filesystem,
    ) {
    }

    public function getGeneratorFiber(): Fiber
    {
        return new Fiber($this->generateTransfers(...));
    }

    private function generateTransfers(): bool
    {
        $this->filesystem->createTempDir();
        Fiber::suspend($this->reader->countDefinitions());

        $isSuccessful = true;
        foreach ($this->reader->getDefinitions() as $definitionKey => $definitionTransfer) {
            if ($definitionTransfer->validator->isValid) {
                $content = $this->renderer->renderTemplate($definitionTransfer->template);
                $this->filesystem->writeFile($definitionTransfer->template->className, $content);
            }

            $generatorTransfer = new GeneratorTransfer();
            $generatorTransfer->definitionKey = $definitionKey;
            $generatorTransfer->validator = $definitionTransfer->validator;

            $isSuccessful = $isSuccessful && $definitionTransfer->validator->isValid;

            Fiber::suspend($generatorTransfer);
        }

        $this->filesystem->rotateTempDir();

        return $isSuccessful;
    }
}

