<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Generator;

use Fiber;
use Picamator\TransferObject\Definition\DefinitionFacadeInterface;
use Picamator\TransferObject\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\Generator\GeneratorFacade;
use Picamator\TransferObject\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\Transfer\Generated\DefinitionTransfer;
use Picamator\TransferObject\Transfer\Generated\GeneratorTransfer;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionFacadeInterface $definitionFacade,
        private TemplateRenderInterface $renderer,
        private GeneratorFilesystemInterface $filesystem,
    ) {
    }

    public function generateTransfers(callable $handleCallback): bool
    {
        $generatorFiber = new Fiber($this->fiberCallback(...));

        $generatorFiber->start();
        while (!$generatorFiber->isTerminated()) {
            /** @var \Picamator\TransferObject\Transfer\Generated\GeneratorTransfer|null $generatorTransfer */
            $generatorTransfer = $generatorFiber->resume();
            if ($generatorTransfer?->validator?->isValid === false) {
                $handleCallback($generatorTransfer);
            }
        }

        return $generatorFiber->getReturn();
    }

    private function fiberCallback(): bool
    {
        $this->filesystem->createTempDir();
        Fiber::suspend();

        $isValid = true;
        $definitionGenerator = $this->definitionFacade->getDefinitions();
        foreach ($definitionGenerator as $definitionKey => $definitionTransfer) {
            $this->generateTransfer($definitionTransfer);

            $isValid = $isValid && $definitionTransfer->validator?->isValid;
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
        if (!$definitionTransfer->validator?->isValid) {
            return;
        }

        $content = $this->renderer->renderTemplate($definitionTransfer->content);
        $this->filesystem->writeFile($definitionTransfer->content->className, $content);
    }
}
