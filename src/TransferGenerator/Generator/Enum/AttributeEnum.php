<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\DateTimePropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\NumberPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

enum AttributeEnum: string
{
    case TYPE_ATTRIBUTE = PropertyTypeAttribute::class;
    case COLLECTION_TYPE_ATTRIBUTE = CollectionPropertyTypeAttribute::class;
    case ENUM_TYPE_ATTRIBUTE = EnumPropertyTypeAttribute::class;
    case ARRAY_OBJECT_TYPE_ATTRIBUTE = ArrayObjectPropertyTypeAttribute::class;
    case ARRAY_TYPE_ATTRIBUTE = ArrayPropertyTypeAttribute::class;
    case DATE_TIME_TYPE_ATTRIBUTE = DateTimePropertyTypeAttribute::class;
    case NUMBER_TYPE_ATTRIBUTE = NumberPropertyTypeAttribute::class;
}
