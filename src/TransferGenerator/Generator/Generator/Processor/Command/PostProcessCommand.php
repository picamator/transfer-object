<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\CacheFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;

readonly class PostProcessCommand implements PostProcessCommandInterface
{
    public function __construct(
        private TransferGeneratorBuilderInterface $builder,
        private CacheFilesystemInterface $cacheFilesystem,
        private GeneratorFilesystemInterface $filesystem,
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
            $this->cacheFilesystem->closeTempCache();
            $deleteClassNames = $this->getDeleteClassNames();

            $this->filesystem->rotateTempDir($deleteClassNames);
        } catch (FilesystemException | FinderException | TransferGeneratorConfigNotFoundException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    /**
     * @return array<int, string>
     */
    private function getDeleteClassNames(): array
    {
        $tempCache = $this->cacheFilesystem->readFromTempCache();
        $cache = $this->cacheFilesystem->readFromCache();

        $deletedClasses = [];
        // phpcs:disable SlevomatCodingStandard.Variables.UnusedVariable
        foreach ($cache as $className => $hash) {
            if (isset($tempCache[$className])) {
                continue;
            }

            $deletedClasses[] = $className;
        }

        return $deletedClasses;
    }

    private function postProcessError(): TransferGeneratorTransfer
    {
        try {
            $this->cacheFilesystem->closeTempCache();
            $this->filesystem->deleteTempDir();
        } catch (FilesystemException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }
}
