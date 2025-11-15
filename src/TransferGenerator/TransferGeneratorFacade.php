<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use NoDiscard;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    private static TransferGeneratorFactory $factory;

    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    #[NoDiscard]
    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorFiber()
            ->getTransferGeneratorFiber();
    }

    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer>
     */
    #[NoDiscard]
    public function getTransferGeneratorBulkFiber(): Fiber
    {
        return $this->getFactory()
            ->createTransferGeneratorBulkFiber()
            ->getTransferGeneratorFiber();
    }

    #[NoDiscard('The result should be used to validate how many definitions were generated.')]
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
