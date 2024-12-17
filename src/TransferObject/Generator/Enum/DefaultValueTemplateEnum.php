<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum DefaultValueTemplateEnum: string
{
    case ARRAY = '[]';
    case ARRAY_OBJECT = 'new ArrayObject()';
}
