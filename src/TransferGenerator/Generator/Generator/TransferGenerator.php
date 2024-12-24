<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private TemplateRenderInterface $renderer,
        private GeneratorFilesystemInterface $filesystem,
    ) {
    }

    public function generateTransfers(callable $handleCallback): bool
    {
        $generatorFiber = new Fiber($this->fiberCallback(...));

        $generatorFiber->start();
        while (!$generatorFiber->isTerminated()) {
            /** @var \Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer|null $generatorTransfer */
            $generatorTransfer = $generatorFiber->resume();
            if ($generatorTransfer?->validator?->isValid === false) {
                $handleCallback($generatorTransfer);
            }
        }

        return $generatorFiber->getReturn();
    }

    public function getTransferGeneratorFiber(): Fiber
    {
        return new Fiber($this->fiberCallback(...));
    }

    /**
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     * @throws \FiberError
     */
    private function fiberCallback(): bool
    {
        $this->filesystem->createTempDir();
        Fiber::suspend();

        $isValid = true;
        $definitionGenerator = $this->definitionReader->getDefinitions();
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

    private function createGeneratorTransfer(string $definitionKey, DefinitionTransfer $definitionTransfer): TransferGeneratorCallbackTransfer
    {
        $generatorTransfer = new TransferGeneratorCallbackTransfer();

        $generatorTransfer->className = $definitionTransfer->content?->className;
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

