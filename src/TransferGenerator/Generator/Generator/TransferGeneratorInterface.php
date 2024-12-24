<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Fiber;

interface TransferGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     * @throws \FiberError
     *
     * @return \Fiber<null,null,bool,\Picamator\TransferObject\Generated\TransferGeneratorCallbackTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;
}
