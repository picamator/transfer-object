<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;

interface TransferGeneratorBulkFiberInterface
{
    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;
}
