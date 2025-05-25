<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface ProcessCommandInterface
{
    public function process(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer;
}
