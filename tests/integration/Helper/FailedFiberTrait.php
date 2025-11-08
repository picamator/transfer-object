<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use Fiber;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

trait FailedFiberTrait
{
    /**
     * @phpstan-ignore missingType.generics
     */
    final protected function getFailedFiber(): Fiber
    {
        return new Fiber(
            fn() => throw new TransferGeneratorException('Fiber cannot be started.'),
        );
    }
}
