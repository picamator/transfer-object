<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Fiber;

use Closure;

interface GeneratorFiberInterface
{
    public function generateTransfers(Closure $errorItemCallback): bool;
}
