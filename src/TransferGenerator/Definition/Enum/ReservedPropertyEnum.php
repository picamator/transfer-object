<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum ReservedPropertyEnum: string
{
    /**
     * @uses \Picamator\TransferObject\Transfer\AbstractTransfer::$_data
     */
    case DATA = '_data';

    /**
     * @uses \Picamator\TransferObject\Transfer\Attribute\AttributeTrait::$_attributeCache
     */
    case ATTRIBUTE_CACHE = '_attributeCache';
}
