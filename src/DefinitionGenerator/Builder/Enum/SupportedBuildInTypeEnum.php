<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Enum;

enum SupportedBuildInTypeEnum: string
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
}
