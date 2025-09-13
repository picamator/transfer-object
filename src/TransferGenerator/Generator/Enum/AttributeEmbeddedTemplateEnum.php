<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;

enum AttributeEmbeddedTemplateEnum: string
{
    case TYPE_ATTRIBUTE = '#[PropertyTypeAttribute(%s::class)]';
    case COLLECTION_TYPE_ATTRIBUTE = '#[CollectionPropertyTypeAttribute(%s::class)]';
    case ENUM_TYPE_ATTRIBUTE = '#[EnumPropertyTypeAttribute(%s::class)]';
    case DATE_TIME_TYPE_ATTRIBUTE = '#[DateTimePropertyTypeAttribute(%s::class)]';
    case NUMBER_TYPE_ATTRIBUTE = '#[NumberPropertyTypeAttribute(%s::class)]';

    public function renderTemplate(DefinitionEmbeddedTypeTransfer $embeddedTypeTransfer): string
    {
        return sprintf($this->value, $embeddedTypeTransfer->name);
    }
}
