<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator;

use Fiber;

interface GeneratorFiberInterface
{
    public function getGeneratorFiber(): Fiber;
}
