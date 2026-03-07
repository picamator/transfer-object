<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Reader;

use Picamator\TransferObject\Generated\TransferHashTransfer;

interface TransferHashReaderInterface
{
    public function readHashFile(): TransferHashTransfer;
}
