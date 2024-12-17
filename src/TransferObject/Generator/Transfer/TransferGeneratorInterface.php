<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Transfer;

interface TransferGeneratorInterface
{
    public function generateTransfers(callable $errorItemCallback): bool;
}
