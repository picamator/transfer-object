<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

interface BulkTransferGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function generateTransfers(): void;
}
