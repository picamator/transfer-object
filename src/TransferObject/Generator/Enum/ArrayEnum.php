<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum ArrayEnum: string
{
    case TYPE = 'array';
    case DEFAULT_VALUE_TEMPLATE = '[]';
}
