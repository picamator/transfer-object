<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Enum;

enum ReservedPropertyEnum: string
{
    /**
     * @uses \Picamator\TransferObject\Transfer\AbstractTransfer::_data
     */
    case DATA = '_data';

    /**
     * @uses \Picamator\TransferObject\Transfer\ConstantAttributeTrait::_reflectionObjectReference
     */
    case REFLECTION_OBJECT_REFERENCE = '_reflectionObjectReference';
}
