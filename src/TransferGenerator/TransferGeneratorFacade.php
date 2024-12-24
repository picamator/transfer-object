<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\TransferGenerator\Generator\TransferGeneratorFactory;

readonly class TransferGeneratorFacade implements TransferGeneratorFacadeInterface
{
    public function getTransferGeneratorFiber(): Fiber
    {
        return new TransferGeneratorFactory()
            ->createTransferGenerator()
            ->getTransferGeneratorFiber();
    }
}
