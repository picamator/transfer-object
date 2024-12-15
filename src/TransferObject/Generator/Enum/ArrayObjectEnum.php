<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum ArrayObjectEnum: string
{
    case CLASS_NAME = 'ArrayObject';
    case DOCK_BLOCK_TEMPLATE = '/** @var \ArrayObject<%s> */';
    case DEFAULT_VALUE_TEMPLATE = 'new ArrayObject()';
}
