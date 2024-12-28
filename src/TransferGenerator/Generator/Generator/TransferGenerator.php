<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Reader\DefinitionReaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer;
use Throwable;

readonly class TransferGenerator implements TransferGeneratorInterface
{
    public function __construct(
        private DefinitionReaderInterface $definitionReader,
        private TemplateRenderInterface $renderer,
        private GeneratorFilesystemInterface $filesystem,
    ) {
    }

    public function getTransferGeneratorFiber(): Fiber
    {
        return new Fiber($this->fiberCallback(...));
    }

    /**
     * @throws \FiberError
     * @throws \Throwable
     */
    private function fiberCallback(): bool
    {
        $this->filesystem->createTempDir();
        Fiber::suspend();

        $validCount = 0;
        $definitionGenerator = $this->definitionReader->getDefinitions();
        foreach ($definitionGenerator as $definitionKey => $definitionTransfer) {
            $definitionTransfer = $this->generateTransfer($definitionTransfer);

            $validCount += (int)$definitionTransfer->validator?->isValid;
            $generatorTransfer = $this->createGeneratorTransfer($definitionKey, $definitionTransfer);

            Fiber::suspend($generatorTransfer);
        }

        $totalCount = $definitionGenerator->getReturn();
        $isValid = $totalCount > 0 && $totalCount === $validCount;
        if ($isValid) {
            $this->filesystem->rotateTempDir();
        }

        return $isValid;
    }

    private function createGeneratorTransfer(
        string $definitionKey,
        DefinitionTransfer $definitionTransfer,
    ): TransferGeneratorCallbackTransfer {
        $generatorTransfer = new TransferGeneratorCallbackTransfer();

        $generatorTransfer->className = $definitionTransfer->content?->className;
        $generatorTransfer->definitionKey = $definitionKey;
        $generatorTransfer->validator = $definitionTransfer->validator;

        return $generatorTransfer;
    }

    private function generateTransfer(DefinitionTransfer $definitionTransfer): DefinitionTransfer
    {
        if (!$definitionTransfer->validator?->isValid) {
            return $definitionTransfer;
        }

        try {
            $content = $this->renderer->renderTemplate($definitionTransfer->content);
            $this->filesystem->writeFile($definitionTransfer->content->className, $content);

            return $definitionTransfer;
        } catch (Throwable $e) {
            $definitionTransfer->validator->isValid = false;
            $definitionTransfer->validator->errorMessages[] = new ValidatorMessageTransfer()
                ->fromArray([
                    ValidatorMessageTransfer::IS_VALID => false,
                    ValidatorMessageTransfer::ERROR_MESSAGE => $e->getMessage(),
                ]);

            return $definitionTransfer;
        }
    }
}
