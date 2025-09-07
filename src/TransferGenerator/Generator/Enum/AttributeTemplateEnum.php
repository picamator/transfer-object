<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum AttributeTemplateEnum: string
{
    case ARRAY_OBJECT_TYPE_ATTRIBUTE = '#[ArrayObjectPropertyTypeAttribute]';
    case ARRAY_TYPE_ATTRIBUTE = '#[ArrayPropertyTypeAttribute]';
}
