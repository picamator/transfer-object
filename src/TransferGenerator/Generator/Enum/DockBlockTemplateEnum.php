<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum DockBlockTemplateEnum: string
{
    case COLLECTION = '\ArrayObject<int,%s>';
    case ARRAY = 'array<int|string,mixed>';
    case ARRAY_OBJECT = '\ArrayObject<string|int,mixed>';
}
