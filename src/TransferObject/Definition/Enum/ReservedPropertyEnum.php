<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Enum;

enum ReservedPropertyEnum: string
{
    case _DATA = '_data';

    public static function isInvalid(string $type): bool
    {
        return self::tryFrom($type) !== null;
    }
}
