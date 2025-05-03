<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder\Enum;

enum ObjectTypeEnum: string
{
    case ARRAY_OBJECT = 'ArrayObject';
    case ITERABLE = 'iterable';
    case DATE_TIME = 'DateTime';
}
