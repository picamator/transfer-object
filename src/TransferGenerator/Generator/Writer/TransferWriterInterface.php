<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Writer;

use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;

interface TransferWriterInterface
{
    public function writeFile(TransferGeneratorContentTransfer $contentTransfer): void;
}
