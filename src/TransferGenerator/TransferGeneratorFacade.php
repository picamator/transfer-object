<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    private static TransferGeneratorFactory $factory;

    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorFiber()
            ->getTransferGeneratorFiber();
    }

    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer>
     */
    public function getTransferGeneratorBulkFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorBulkFiber()
            ->getTransferGeneratorFiber();
    }

    public function generateTransfersOrFail(string $configPath): int
    {
        return $this->getFactory()
            ->createTransferGeneratorService()
            ->generateTransfersOrFail($configPath);
    }

    private function getFactory(): TransferGeneratorFactory
    {
        return self::$factory ??= new TransferGeneratorFactory();
    }
}
