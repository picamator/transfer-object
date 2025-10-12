<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\DateTimeTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\EnumTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\NumberTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

enum TransformerAttributeTemplateEnum: string
{
    case TRANSFER = '#[TransferTransformerAttribute(%s::class)]';
    case COLLECTION = '#[CollectionTransformerAttribute(%s::class)]';
    case DATE_TIME = '#[DateTimeTransformerAttribute(%s::class)]';
    case ENUM = '#[EnumTransformerAttribute(%s::class)]';
    case NUMBER = '#[NumberTransformerAttribute(%s::class)]';

    private const array IMPORT_MAP = [
        self::TRANSFER->name => TransferTransformerAttribute::class,
        self::COLLECTION->name => CollectionTransformerAttribute::class,
        self::DATE_TIME->name => DateTimeTransformerAttribute::class,
        self::ENUM->name => EnumTransformerAttribute::class,
        self::NUMBER->name => NumberTransformerAttribute::class,
    ];

    public function renderTemplate(DefinitionEmbeddedTypeTransfer $typeTransfer): string
    {
        return sprintf($this->value, $typeTransfer->name);
    }

    public function getImport(): string
    {
        return self::IMPORT_MAP[$this->name];
    }
}
