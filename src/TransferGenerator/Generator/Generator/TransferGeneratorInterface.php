<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;
use Picamator\TransferObject\Command\Helper\ProgressBarInterface;

interface TransferGeneratorInterface
{
    /**
     * @return \Generator<int,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    public function getTransferGenerator(): Generator;

    /**
     * @throws \FiberError
     * @throws \Throwable
     */
    public function getTransferFiberCallback(ProgressBarInterface $progressBar): bool;

    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function generateTransfers(): void;
}
