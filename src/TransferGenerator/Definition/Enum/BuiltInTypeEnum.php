<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum BuiltInTypeEnum: string
{
    case BOOL = 'bool';
    case TRUE = 'true';
    case FALSE = 'false';
    case INT = 'int';
    case FLOAT = 'float';
    case STRING = 'string';
    case ARRAY = 'array';
    case ARRAY_OBJECT = 'ArrayObject';

    private const array IS_ALLOWED = [
        self::BOOL,
        self::TRUE,
        self::FALSE,
        self::INT,
        self::FLOAT,
        self::STRING,
        self::ARRAY,
        self::ARRAY_OBJECT,
    ];

    case ITERABLE = 'iterable';
    case NULL = 'null';
    case OBJECT = 'object';
    case MIXED = 'mixed';
    case CALLABLE = 'callable';

    public function isArray(): bool
    {
        return $this === self::ARRAY;
    }

    public function isArrayObject(): bool
    {
        return $this === self::ARRAY_OBJECT;
    }

    public function isAllowed(): bool
    {
        return in_array($this, self::IS_ALLOWED, true);
    }
}
