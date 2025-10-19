<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum DockBlockTemplateEnum: string
{
    case ARRAY = '/** @var array%s */';
    case ARRAY_OBJECT = '/** @var \ArrayObject%s */';

    private const string DEFAULT_DOCK_BLOCK = '<int|string,mixed>';

    public function renderTemplate(?string $dockBlock): string
    {
        return sprintf($this->value, $dockBlock ?: self::DEFAULT_DOCK_BLOCK);
    }
}
