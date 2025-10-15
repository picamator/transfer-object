<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayObjectTransformerAttribute;

enum TransformerAttributeEnum: string
{
    case ARRAY_OBJECT = '#[ArrayObjectTransformerAttribute]';

    private const array IMPORT_MAP = [
        self::ARRAY_OBJECT->name => ArrayObjectTransformerAttribute::class,
    ];

    public function getImport(): string
    {
        return self::IMPORT_MAP[$this->name];
    }
}
