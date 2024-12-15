<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum ArrayEnum: string
{
    case TYPE = 'array';
    case DOCK_BLOCK_TEMPLATE = '/** @var array<mixed> */';
    case DEFAULT_VALUE_TEMPLATE = '[]';
}
