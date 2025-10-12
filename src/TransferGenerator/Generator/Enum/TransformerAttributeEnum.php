<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayObjectTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayTransformerAttribute;

enum TransformerAttributeEnum: string
{
    case ARRAY = '#[ArrayTransformerAttribute]';
    case ARRAY_OBJECT = '#[ArrayObjectTransformerAttribute]';

    private const array IMPORT_MAP = [
        self::ARRAY->name => ArrayTransformerAttribute::class,
        self::ARRAY_OBJECT->name => ArrayObjectTransformerAttribute::class,
    ];

    public function getImport(): string
    {
        return self::IMPORT_MAP[$this->name];
    }
}
