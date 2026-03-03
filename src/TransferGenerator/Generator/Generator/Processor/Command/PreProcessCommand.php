<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Writer\TransferLockerInterface;

readonly class PreProcessCommand implements PreProcessCommandInterface
{
    public function __construct(
        private ConfigLoaderInterface $configLoader,
        private TransferGeneratorBuilderInterface $builder,
        private GeneratorFilesystemInterface $filesystem,
        private TransferLockerInterface $transferLocker,
    ) {
    }

    public function preProcess(string $configPath): TransferGeneratorTransfer
    {
        $generatorTransfer = $this->loadConfig($configPath);
        if ($generatorTransfer !== null) {
            return $generatorTransfer;
        }

        $generatorTransfer = $this->createTempDir();
        if ($generatorTransfer !== null) {
            return $generatorTransfer;
        }

        return $this->builder->createSuccessGeneratorTransfer();
    }

    private function createTempDir(): ?TransferGeneratorTransfer
    {
        try {
            $this->filesystem->createTempDir();
            $this->transferLocker->acquireLock();
        } catch (FilesystemException $e) {
            return $this->builder->createErrorGeneratorTransfer($e->getMessage());
        }

        return null;
    }

    private function loadConfig(string $configPath): ?TransferGeneratorTransfer
    {
        $configTransfer = $this->configLoader->loadConfig($configPath);
        if (!$configTransfer->validator->isValid) {
            return $this->builder->createGeneratorTransferByConfig($configPath, $configTransfer);
        }

        return null;
    }
}
