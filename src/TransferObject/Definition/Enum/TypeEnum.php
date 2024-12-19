<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Enum;

enum TypeEnum: string
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

    public static function isTransfer(string $type): bool
    {
        return self::tryFrom($type) === null;
    }
}
