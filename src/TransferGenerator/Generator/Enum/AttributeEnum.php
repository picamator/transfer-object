<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

enum AttributeEnum: string
{
    case TYPE_ATTRIBUTE = PropertyTypeAttribute::class;
    case COLLECTION_TYPE_ATTRIBUTE = CollectionPropertyTypeAttribute::class;
    case ENUM_TYPE_ATTRIBUTE = EnumPropertyTypeAttribute::class;
    case ARRAY_OBJECT_TYPE_ATTRIBUTE = ArrayObjectPropertyTypeAttribute::class;
}
