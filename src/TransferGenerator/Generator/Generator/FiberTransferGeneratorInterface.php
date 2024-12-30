<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Command\Helper\ProgressBarInterface;

interface FiberTransferGeneratorInterface
{
    /**
     * @throws \FiberError
     * @throws \Throwable
     */
    public function getTransferFiberCallback(ProgressBarInterface $progressBar): bool;
}
