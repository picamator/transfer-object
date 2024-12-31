<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

interface FiberTransferGeneratorInterface
{
    /**
     * @throws \FiberError
     * @throws \Throwable
     */
    public function getTransferFiberCallback(): bool;
}
