<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Enum;

use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\CollectionInitiatorAttribute;

enum InitiatorAttributeEnum: string
{
    case ARRAY = '#[ArrayInitiatorAttribute]';
    case ARRAY_OBJECT = '#[ArrayObjectInitiatorAttribute]';
    case COLLECTION = '#[CollectionInitiatorAttribute]';

    private const array IMPORT_MAP = [
        self::ARRAY->name => ArrayInitiatorAttribute::class,
        self::ARRAY_OBJECT->name => ArrayObjectInitiatorAttribute::class,
        self::COLLECTION->name => CollectionInitiatorAttribute::class,
    ];

    public function getImport(): string
    {
        return self::IMPORT_MAP[$this->name];
    }
}
