<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

readonly class GeneratorProcessor implements GeneratorProcessorInterface
{
    public function __construct(
        private ConfigLoaderInterface $configLoader,
        private TransferGeneratorBuilderInterface $builder,
        private TemplateRenderInterface $render,
        private GeneratorFilesystemInterface $filesystem,
    ) {
    }

    public function preProcess(string $configPath): TransferGeneratorTransfer
    {
        $configTransfer = $this->configLoader->loadConfig($configPath);
        if (!$configTransfer->validator->isValid) {
            $errorMessage = $configTransfer->validator->errorMessages[0] ?? null;

            return $this->builder->createErrorGeneratorTransfer($errorMessage?->errorMessage ?: '');
        }

        try {
            $this->filesystem->createTempDir();
        } catch (FilesystemException $e) {
            return $this->builder->createExceptionGeneratorTransfer($e);
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    public function postProcessSuccess(): TransferGeneratorTransfer
    {
        try {
            $this->filesystem->rotateTempDir();
        } catch (FilesystemException | FinderException $e) {
            return $this->builder->createExceptionGeneratorTransfer($e);
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    public function postProcessError(): TransferGeneratorTransfer
    {
        try {
            $this->filesystem->deleteTempDir();
        } catch (FilesystemException $e) {
            return $this->builder->createExceptionGeneratorTransfer($e);
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    public function process(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        if (!$definitionTransfer->validator?->isValid) {
            return $this->builder->createGeneratorTransfer($definitionTransfer);
        }

        try {
            $content = $this->render->renderTemplate($definitionTransfer->content);
            $this->filesystem->writeFile($definitionTransfer->content->className, $content);

            return $this->builder->createGeneratorTransfer($definitionTransfer);
        } catch (FilesystemException | TransferGeneratorException $e) {
            return $this->builder->createExceptionGeneratorTransfer($e, $definitionTransfer);
        }
    }
}
