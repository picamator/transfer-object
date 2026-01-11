<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

enum DocBlockTemplateEnum: string
{
    case ARRAY = '/** @var array%s */';
    case ARRAY_OBJECT = '/** @var \ArrayObject%s */';

    private const string DEFAULT_DOC_BLOCK = '<int|string,mixed>';

    public function renderTemplate(?string $docBlock): string
    {
        return sprintf($this->value, $docBlock ?: self::DEFAULT_DOC_BLOCK);
    }
}
