<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum ReservedPropertyEnum: string
{
    case _DATA = '_data';

    public static function isReserved(string $propertyName): bool
    {
        return self::tryFrom($propertyName) !== null;
    }
}
