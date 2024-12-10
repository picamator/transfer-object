<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

enum CollectionPropertyTypeEnum: string
{
    case CLASS_NAME = CollectionPropertyTypeAttribute::class;
    case ATTRIBUTE_TEMPLATE = 'CollectionPropertyTypeAttribute(%s::class)';
    case DOCK_BLOCK_TEMPLATE = '\ArrayObject<%s>';
}
