<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface TransferGeneratorFiberInterface
{
    /**
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;
}
