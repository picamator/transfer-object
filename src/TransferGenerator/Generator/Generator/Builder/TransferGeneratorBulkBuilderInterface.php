<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\FileReaderProgressTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorBulkTransfer;

interface TransferGeneratorBulkBuilderInterface
{
    public function createSuccessBulkTransfer(
        FileReaderProgressTransfer $progressTransfer,
    ): TransferGeneratorBulkTransfer;

    public function createFailedBulkTransfer(
        string $errorMessage,
        ?FileReaderProgressTransfer $progressTransfer = null,
    ): TransferGeneratorBulkTransfer;

    public function createDefaultProgressTransfer(): FileReaderProgressTransfer;
}
