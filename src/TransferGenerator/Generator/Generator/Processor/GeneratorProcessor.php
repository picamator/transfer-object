<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException;
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
            return $this->builder->createGeneratorTransferByConfig($configPath, $configTransfer);
        }

        try {
            $this->filesystem->createTempDir();
        } catch (FilesystemException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    public function postProcessSuccess(): TransferGeneratorTransfer
    {
        try {
            $this->filesystem->rotateTempDir();
        } catch (FilesystemException | FinderException | TransferGeneratorConfigNotFoundException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    public function postProcessError(): TransferGeneratorTransfer
    {
        try {
            $this->filesystem->deleteTempDir();
        } catch (FilesystemException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    public function process(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer
    {
        if (!$definitionTransfer->validator->isValid) {
            return $this->builder->createGeneratorTransferByDefinition($definitionTransfer);
        }

        try {
            $content = $this->render->renderTemplate($definitionTransfer);
            $this->filesystem->writeFile($definitionTransfer->content->className, $content);

            return $this->builder->createGeneratorTransferByDefinition($definitionTransfer);
        } catch (FilesystemException | TransferGeneratorException $e) {
            return $this->builder->createErrorWithDefinitionGeneratorTransfer($e->getMessage(), $definitionTransfer);
        }
    }
}
