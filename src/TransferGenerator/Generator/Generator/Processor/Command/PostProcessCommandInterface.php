<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface PostProcessCommandInterface
{
    public function postProcess(bool $isSuccessful): TransferGeneratorTransfer;
}
