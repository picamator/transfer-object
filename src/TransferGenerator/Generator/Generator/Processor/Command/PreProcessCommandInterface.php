<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface PreProcessCommandInterface
{
    public function preProcess(string $configPath): TransferGeneratorTransfer;
}
