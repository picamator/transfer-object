<?php

declare(strict_types=1);

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

    private const array NOT_ALLOWED = [
        self::ITERABLE,
        self::NULL,
        self::OBJECT,
        self::MIXED,
        self::CALLABLE,
    ];

    public static function getTrueFalse(bool $value): self
    {
        if ($value === true) {
            return self::TRUE;
        }

        return self::FALSE;
    }

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
        return !in_array($this, self::NOT_ALLOWED, true);
    }
}
