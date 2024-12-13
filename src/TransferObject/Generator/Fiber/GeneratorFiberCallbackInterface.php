<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Fiber;

use Fiber;

interface GeneratorFiberCallbackInterface
{
    public function getFiberCallback(): bool;
}
