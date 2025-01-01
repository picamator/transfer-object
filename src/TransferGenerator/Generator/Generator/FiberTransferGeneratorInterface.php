<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

interface FiberTransferGeneratorInterface
{
    public function getTransferFiberCallback(string $configPath): bool;
}
