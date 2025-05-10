<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/definition-generator/definition/product.transfer.yml Definition file path.
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
        get => $this->getData(self::BOX_DATA_INDEX);
        set => $this->setData(self::BOX_DATA_INDEX, $value);
    }

    // palette
    #[PropertyTypeAttribute(PaletteTransfer::class)]
    public const string PALETTE = 'palette';
    protected const string PALETTE_DATA_NAME = 'PALETTE';
    protected const int PALETTE_DATA_INDEX = 1;

    public ?PaletteTransfer $palette {
        get => $this->getData(self::PALETTE_DATA_INDEX);
        set => $this->setData(self::PALETTE_DATA_INDEX, $value);
    }
}
