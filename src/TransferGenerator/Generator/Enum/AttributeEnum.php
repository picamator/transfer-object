<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayObjectTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\DateTimeTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\EnumTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\NumberTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

enum AttributeEnum: string
{
    case TYPE_ATTRIBUTE = TransferTransformerAttribute::class;
    case COLLECTION_TYPE_ATTRIBUTE = CollectionTransformerAttribute::class;
    case ENUM_TYPE_ATTRIBUTE = EnumTransformerAttribute::class;
    case ARRAY_OBJECT_TYPE_ATTRIBUTE = ArrayObjectTransformerAttribute::class;
    case ARRAY_TYPE_ATTRIBUTE = ArrayTransformerAttribute::class;
    case DATE_TIME_TYPE_ATTRIBUTE = DateTimeTransformerAttribute::class;
    case NUMBER_TYPE_ATTRIBUTE = NumberTransformerAttribute::class;
}
