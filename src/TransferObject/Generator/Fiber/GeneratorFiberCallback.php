<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Fiber;

use Fiber;
use Picamator\TransferObject\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\GeneratorTransfer;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\Generator\Render\TemplateRenderInterface;

readonly class GeneratorFiberCallback implements GeneratorFiberCallbackInterface
{
    public function __construct(
        private DefinitionReaderInterface $reader,
        private TemplateRenderInterface $renderer,
        private GeneratorFilesystemInterface $filesystem,
    ) {
    }

    public function getFiberCallback(): bool
    {
        $this->filesystem->createTempDir();
        Fiber::suspend();

        $isValid = true;
        $definitionGenerator = $this->reader->getDefinitions();
        foreach ($definitionGenerator as $definitionKey => $definitionTransfer) {
            $this->generateTransfer($definitionTransfer);

            $isValid = $isValid && $definitionTransfer->validator->isValid;
            $generatorTransfer = $this->createGeneratorTransfer($definitionKey, $definitionTransfer);

            Fiber::suspend($generatorTransfer);
        }

        $isValid = $isValid && $definitionGenerator->getReturn() > 0;
        if ($isValid) {
            $this->filesystem->rotateTempDir();
        }

        return $isValid;
    }

    private function createGeneratorTransfer(string $definitionKey, DefinitionTransfer $definitionTransfer): GeneratorTransfer
    {
        $generatorTransfer = new GeneratorTransfer();

        $generatorTransfer->definitionKey = $definitionKey;
        $generatorTransfer->validator = $definitionTransfer->validator;

        return $generatorTransfer;
    }

    private function generateTransfer(DefinitionTransfer $definitionTransfer): void
    {
        if (!$definitionTransfer->validator->isValid) {
            return;
        }

        $content = $this->renderer->renderTemplate($definitionTransfer->content);
        $this->filesystem->writeFile($definitionTransfer->content->className, $content);
    }
}

