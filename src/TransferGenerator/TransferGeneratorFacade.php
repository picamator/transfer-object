<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    private static TransferGeneratorFactory $factory;

    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGenerator()
            ->getTransferGeneratorFiber();
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
