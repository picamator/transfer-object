<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

enum AttributeEnum: string
{
    case TYPE_ATTRIBUTE = PropertyTypeAttribute::class;
    case COLLECTION_TYPE_ATTRIBUTE = CollectionPropertyTypeAttribute::class;
}
