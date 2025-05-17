<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;

interface TransferGeneratorBulkFiberInterface
{
    /**
     * @return \Fiber<string,null,bool,TransferGeneratorBulkTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;
}
