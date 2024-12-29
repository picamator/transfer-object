<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Generator;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    private static TransferGeneratorFactory $factory;

    public function getTransferGenerator(): Generator
    {
        return $this->getFactory()
            ->createTransferGenerator()
            ->getTransferGenerator();
    }

    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorFiber();
    }

    public function generateTransfers(): void
    {
        $this->getFactory()
            ->createTransferGenerator()
            ->generateTransfers();
    }

    public function loadConfig(string $configPath): ConfigTransfer
    {
        return $this->getFactory()
            ->createConfigLoader()
            ->loadConfig($configPath);
    }

    private function getFactory(): TransferGeneratorFactory
    {
        return self::$factory ??= new TransferGeneratorFactory();
    }
}
