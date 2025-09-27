<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/item-collection.transfer.yml Definition file path.
 */
final class ItemCollectionTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ITEM_INDEX => self::ITEM,
        self::ITEMS_INDEX => self::ITEMS,
    ];

    // item
    #[PropertyTypeAttribute(ItemTransfer::class)]
    public const string ITEM = 'item';
    private const int ITEM_INDEX = 0;

    public ?ItemTransfer $item {
        get => $this->getData(self::ITEM_INDEX);
        set => $this->setData(self::ITEM_INDEX, $value);
    }

    // items
    #[CollectionPropertyTypeAttribute(ItemTransfer::class)]
    public const string ITEMS = 'items';
    private const int ITEMS_INDEX = 1;

    /** @var \ArrayObject<int,ItemTransfer> */
    public ArrayObject $items {
        get => $this->getData(self::ITEMS_INDEX);
        set => $this->setData(self::ITEMS_INDEX, $value);
    }
}
