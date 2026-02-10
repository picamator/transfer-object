<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use NoDiscard;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

readonly class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    public function __construct(
        private TransferGeneratorFactory $factory = new TransferGeneratorFactory(),
    ) {
    }

    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    #[NoDiscard]
    public function getTransferGeneratorFiber(): Fiber
    {
        return $this->factory
            ->createTransferGeneratorFiber()
            ->getTransferGeneratorFiber();
    }

    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer>
     */
    #[NoDiscard]
    public function getTransferGeneratorBulkFiber(): Fiber
    {
        return $this->factory
            ->createTransferGeneratorBulkFiber()
            ->getTransferGeneratorFiber();
    }

    #[NoDiscard('The result should be used to validate how many definitions were generated.')]
    public function generateTransfersOrFail(string $configPath): int
    {
        return $this->factory
            ->createTransferGeneratorService()
            ->generateTransfersOrFail($configPath);
    }
}
