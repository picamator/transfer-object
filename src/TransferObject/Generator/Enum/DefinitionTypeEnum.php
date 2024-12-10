<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum DefinitionTypeEnum: string
{
    case BOOL = 'bool';
    case TRUE = 'true';
    case FALSE = 'false';
    case INT = 'int';
    case FLOAT = 'float';
    case STRING = 'string';
    case ARRAY = 'array';
    case OBJECT = 'object';
    case ARRAY_OBJECT = 'ArrayObject';
    case MIXED = 'mixed';
    case ITERABLE = 'iterable';
}
