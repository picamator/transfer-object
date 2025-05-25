<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;

interface TransferGeneratorFiberInterface
{
    /**
     * @return \Fiber<string,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;
}
