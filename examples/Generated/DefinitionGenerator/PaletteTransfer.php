<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/definition-generator/definition/product.transfer.yml Definition file path.
 */
final class PaletteTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ITEMS_INDEX => self::ITEMS,
        self::TYPE_INDEX => self::TYPE,
    ];

    // items
    public const string ITEMS = 'items';
    private const int ITEMS_INDEX = 0;

    public ?int $items {
        get => $this->getData(self::ITEMS_INDEX);
        set => $this->setData(self::ITEMS_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    private const int TYPE_INDEX = 1;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }
}
