<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Enum;

enum GetTypeEnum: string
{
    case bool = 'boolean';
    case int = 'integer';
    case float = 'double';
    case string = 'string';
    case array = 'array';
    case object = 'object';
    case null = 'NULL';

    public function isNull(): bool
    {
        return match ($this) {
            GetTypeEnum::null => true,
            default => false,
        };
    }

    public function isString(): bool
    {
        return match ($this) {
            GetTypeEnum::string => true,
            default => false,
        };
    }

    public function isObject(): bool
    {
        return match ($this) {
            GetTypeEnum::object => true,
            default => false,
        };
    }

    public function isArray(): bool
    {
        return match ($this) {
            GetTypeEnum::array => true,
            default => false,
        };
    }
}
