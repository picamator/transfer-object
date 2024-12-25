<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class MeasurementUnitTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::BOX => self::BOX_DATA_NAME,
        self::PALETTE => self::PALETTE_DATA_NAME,
    ];

    // box
    #[PropertyTypeAttribute(BoxTransfer::class)]
    public const string BOX = 'box';
    protected const string BOX_DATA_NAME = 'BOX';
    protected const int BOX_DATA_INDEX = 0;

    public ?BoxTransfer $box {
        get => $this->_data[self::BOX_DATA_INDEX];
        set => $this->_data[self::BOX_DATA_INDEX] = $value;
    }

    // palette
    #[PropertyTypeAttribute(PaletteTransfer::class)]
    public const string PALETTE = 'palette';
    protected const string PALETTE_DATA_NAME = 'PALETTE';
    protected const int PALETTE_DATA_INDEX = 1;

    public ?PaletteTransfer $palette {
        get => $this->_data[self::PALETTE_DATA_INDEX];
        set => $this->_data[self::PALETTE_DATA_INDEX] = $value;
    }
}
