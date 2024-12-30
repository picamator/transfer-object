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
        return $this === GetTypeEnum::null;
    }

    public function isString(): bool
    {
        return $this === GetTypeEnum::string;
    }

    public function isObject(): bool
    {
        return $this === GetTypeEnum::object;
    }

    public function isArray(): bool
    {
        return $this === GetTypeEnum::array;
    }
}
