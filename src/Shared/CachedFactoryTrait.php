<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared;

trait CachedFactoryTrait
{
    /**
     * @var array<string,mixed>
     */
    protected array $cache = [];

    protected function getCached(string $key, callable $factory): mixed
    {
        return $this->cache[$key] ??= $factory();
    }
}
