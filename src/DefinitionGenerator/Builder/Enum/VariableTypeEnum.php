<?php declare(strict_types = 1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Enum;

enum VariableTypeEnum: string
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
        return match($this) {
            VariableTypeEnum::null => true,
            default => false,
        };
    }

    public function isString(): bool
    {
        return match($this) {
            VariableTypeEnum::string => true,
            default => false,
        };
    }

    public function isObject(): bool
    {
        return match($this) {
            VariableTypeEnum::object => true,
            default => false,
        };
    }

    public function isArray(): bool
    {
        return match($this) {
            VariableTypeEnum::array => true,
            default => false,
        };
    }
}
