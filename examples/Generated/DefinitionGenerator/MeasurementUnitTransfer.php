<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

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
        self::BOX_INDEX => self::BOX,
        self::PALETTE_INDEX => self::PALETTE,
    ];

    // box
    #[TransferTransformerAttribute(BoxTransfer::class)]
    public const string BOX = 'box';
    private const int BOX_INDEX = 0;

    public ?BoxTransfer $box {
        get => $this->getData(self::BOX_INDEX);
        set => $this->setData(self::BOX_INDEX, $value);
    }

    // palette
    #[TransferTransformerAttribute(PaletteTransfer::class)]
    public const string PALETTE = 'palette';
    private const int PALETTE_INDEX = 1;

    public ?PaletteTransfer $palette {
        get => $this->getData(self::PALETTE_INDEX);
        set => $this->setData(self::PALETTE_INDEX, $value);
    }
}
