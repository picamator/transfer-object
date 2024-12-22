<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum BlackListBuildInTypeEnum: string
{
    case NULL = 'null';
    case OBJECT = 'object';
    case MIXED = 'mixed';
    case CALLABLE = 'callable';

    public static function isBackListed(string $type): bool
    {
        return self::tryFrom($type) !== null;
    }
}
