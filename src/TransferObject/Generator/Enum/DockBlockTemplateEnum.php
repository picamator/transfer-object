<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Enum;

enum DockBlockTemplateEnum: string
{
    case COLLECTION_TYPE_TEMPLATE = '\ArrayObject<int,%s>';
    case ARRAY_TEMPLATE = '/** @var array<mixed> */';
    case ARRAY_OBJECT_TEMPLATE = '\ArrayObject<string|int,mixed>';
}
