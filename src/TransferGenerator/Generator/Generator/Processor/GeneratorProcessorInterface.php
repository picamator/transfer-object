<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor;

use Generator;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface GeneratorProcessorInterface
{
    public function preProcess(string $configPath): TransferGeneratorTransfer;

    /**
     * @return \Generator<int,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    public function process(): Generator;

    public function postProcess(bool $isSuccessful): TransferGeneratorTransfer;
}
