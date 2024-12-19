<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Enum;

enum UnsupportedTypeEnum: string
{
    case NULL = 'null';
    case OBJECT = 'object';
    case MIXED = 'mixed';
    case CALLABLE = 'callable';

    public static function isUnsupported(string $type): bool
    {
        return self::tryFrom($type) !== null;
    }
}
