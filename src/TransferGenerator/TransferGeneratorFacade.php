<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    private static TransferGeneratorFactory $factory;

    /**
     * @return \Fiber<null,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorFiber();
    }

    public function generateTransfers(): void
    {
        $this->getFactory()
            ->createBulkTransferGenerator()
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
