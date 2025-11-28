<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use Fiber;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;

trait FailedFiberTrait
{
    private const \Closure FIBER_CALLBACK = static function (): never {
        throw new TransferGeneratorException('Fiber cannot be started.');
    };

    /**
     * @phpstan-ignore missingType.generics
     */
    final protected function getFailedFiber(): Fiber
    {
        return new Fiber(callback: self::FIBER_CALLBACK);
    }
}
