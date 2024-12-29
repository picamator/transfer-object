<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;
use Throwable;

readonly class GeneratorProcessor implements GeneratorProcessorInterface
{
    public function __construct(
        private TemplateRenderInterface $renderer,
        private GeneratorFilesystemInterface $filesystem,
    ) {
    }

    public function preGenerateTransfer(): void
    {
        $this->filesystem->createTempDir();
    }

    public function postGenerateTransfer(bool $isSuccess): void
    {
        if ($isSuccess) {
            $this->filesystem->rotateTempDir();

            return;
        }

        $this->filesystem->deleteTempDir();
    }

    public function generateTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        if (!$definitionTransfer->validator?->isValid) {
            return $this->createGeneratorTransfer($definitionTransfer);
        }

        try {
            $content = $this->renderer->renderTemplate($definitionTransfer->content);
            $this->filesystem->writeFile($definitionTransfer->content->className, $content);

            return $this->createGeneratorTransfer($definitionTransfer);
        } catch (Throwable $e) {
            return $this->createErrorGeneratorTransfer($e, $definitionTransfer);
        }
    }

    private function createErrorGeneratorTransfer(
        Throwable $e,
        DefinitionTransfer $definitionTransfer,
    ): TransferGeneratorTransfer {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->className = $definitionTransfer->content?->className;
        $generatorTransfer->fileName = $definitionTransfer->fileName;

        $generatorTransfer->validator = new DefinitionValidatorTransfer();
        $generatorTransfer->validator->isValid = false;
        $generatorTransfer->validator->errorMessages[] = new ValidatorMessageTransfer()
            ->fromArray([
                ValidatorMessageTransfer::IS_VALID => false,
                ValidatorMessageTransfer::ERROR_MESSAGE => $e->getMessage(),
            ]);

        return $generatorTransfer;
    }

    private function createGeneratorTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->className = $definitionTransfer->content?->className;
        $generatorTransfer->fileName = $definitionTransfer->fileName;
        $generatorTransfer->validator = $definitionTransfer->validator;

        return $generatorTransfer;
    }
}
