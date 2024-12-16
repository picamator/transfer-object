<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum DefaultValueTemplateEnum: string
{
    case ARRAY_TEMPLATE = '[]';
    case ARRAY_OBJECT_TEMPLATE = 'new ArrayObject()';
}
