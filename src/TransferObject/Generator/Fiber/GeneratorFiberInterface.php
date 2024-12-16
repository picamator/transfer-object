<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Fiber;

interface GeneratorFiberInterface
{
    public function generateTransfers(callable $errorItemCallback): bool;
}
