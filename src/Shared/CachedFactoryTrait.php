<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared;

trait CachedFactoryTrait
{
    /**
     * @var array<string,mixed>
     */
    private static array $cache = [];

    final protected function getCached(string $key, callable $factory): mixed
    {
        return self::$cache[$key] ??= $factory();
    }
}
