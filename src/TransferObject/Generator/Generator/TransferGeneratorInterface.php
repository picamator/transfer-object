<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Generator;

interface TransferGeneratorInterface
{
    public function generateTransfers(callable $handleCallback): bool;
}