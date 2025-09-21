<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Initializer;

use ReflectionClass;

trait LazyGhostInitializerTrait
{
    /**
     * @param class-string $className
     */
    final protected function getLazyGhost(string $className, callable $initializer): object
    {
        $reflection = new ReflectionClass($className);

        return $reflection->newLazyGhost(function (object $ghost) use ($initializer): void {
            $initializer($ghost);
        });
    }
}
