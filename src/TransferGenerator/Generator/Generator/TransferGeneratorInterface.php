<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Generator;

interface TransferGeneratorInterface
{
    /**
     * @return \Generator<int,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    public function generateTransfers(string $configPath): Generator;
}
