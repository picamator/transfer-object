<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

use Picamator\TransferObject\Shared\Environment\Enum\EnvironmentEnum;

trait EnvironmentTrait
{
    private const string IS_CACHE_ENABLED = EnvironmentEnum::IS_CACHE_ENABLED->value;

    final protected static function turnOffCache(): void
    {
        putenv(self::IS_CACHE_ENABLED . '=0');
    }

    final protected static function turnOnCache(): void
    {
        putenv(self::IS_CACHE_ENABLED . '=1');
    }
}
