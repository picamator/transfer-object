<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferRotatorInterface;
use Throwable;

readonly class PostProcessCommand implements PostProcessCommandInterface
{
    public function __construct(
        private TransferGeneratorBuilderInterface $builder,
        private GeneratorFilesystemInterface $filesystem,
        private TransferRotatorInterface $transferRotator,
    ) {
    }

    public function postProcess(bool $isSuccessful): TransferGeneratorTransfer
    {
        if ($isSuccessful) {
            return $this->postProcessSuccess();
        }

        return $this->postProcessError();
    }

    private function postProcessSuccess(): TransferGeneratorTransfer
    {
        try {
            $this->transferRotator->rotateFiles();
            $generatorTransfer = $this->builder->createSuccessGeneratorTransfer();
        } catch (Throwable $e) {
            $generatorTransfer = $this->builder->createErrorGeneratorTransfer($e->getMessage());
        } finally {
            $this->filesystem->deleteTempDir();
        }

        return $generatorTransfer;
    }

    private function postProcessError(): TransferGeneratorTransfer
    {
        try {
            $this->filesystem->deleteTempDir();
        } catch (FilesystemException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }
}
