<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum BuildInTypeEnum: string
{
    case BOOL = 'bool';
    case TRUE = 'true';
    case FALSE = 'false';
    case INT = 'int';
    case FLOAT = 'float';
    case STRING = 'string';
    case ARRAY = 'array';
    case ARRAY_OBJECT = 'ArrayObject';
    case ITERABLE = 'iterable';
    case NULL = 'null';
    case OBJECT = 'object';
    case MIXED = 'mixed';
    case CALLABLE = 'callable';

    public static function isArray(string $type): bool
    {
        return self::ARRAY->value === $type;
    }

    public static function isArrayObject(string $type): bool
    {
        return self::ARRAY_OBJECT->value === $type;
    }

    public static function isIterable(string $type): bool
    {
        return self::ITERABLE->value === $type;
    }

    public static function isBuildInType(string $type): bool
    {
        return self::tryFrom($type) !== null;
    }

    public static function getTrueFalse(bool $value): self
    {
        if ($value === true) {
            return self::TRUE;
        }

        return self::FALSE;
    }
}
