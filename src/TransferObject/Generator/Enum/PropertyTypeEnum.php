<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

enum PropertyTypeEnum: string
{
    case CLASS_NAME = PropertyTypeAttribute::class;
    case ATTRIBUTE_TEMPLATE = 'PropertyTypeAttribute(%s::class)';
}
