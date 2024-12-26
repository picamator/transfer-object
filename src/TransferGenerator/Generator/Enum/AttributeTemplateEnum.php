<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum AttributeTemplateEnum: string
{
    case TYPE_ATTRIBUTE = '#[PropertyTypeAttribute(%s::class)]';
    case COLLECTION_TYPE_ATTRIBUTE = '#[CollectionPropertyTypeAttribute(%s::class)]';
    case ENUM_TYPE_ATTRIBUTE = '#[EnumPropertyTypeAttribute(%s::class)]';
    case ARRAY_OBJECT_TYPE_ATTRIBUTE = '#[ArrayObjectPropertyTypeAttribute()]';
}
