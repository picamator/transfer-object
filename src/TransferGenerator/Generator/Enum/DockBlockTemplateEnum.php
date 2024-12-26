<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum DockBlockTemplateEnum: string
{
    case COLLECTION = '/** @var \ArrayObject<int,%s> */';
    case ARRAY = '/** @var array<int|string,mixed> */';
    case ARRAY_OBJECT = '/** @var \ArrayObject<string|int,mixed> */';
}
