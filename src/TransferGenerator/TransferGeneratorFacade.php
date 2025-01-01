<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    private static TransferGeneratorFactory $factory;

    /**
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorFiber();
    }

    public function generateTransfers(string $configPath): void
    {
        $this->getFactory()
            ->createBulkTransferGenerator()
            ->generateTransfers($configPath);
    }

    private function getFactory(): TransferGeneratorFactory
    {
        return self::$factory ??= new TransferGeneratorFactory();
    }
}
