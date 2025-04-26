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
        self::ITEM => self::ITEM_DATA_NAME,
        self::ITEMS => self::ITEMS_DATA_NAME,
    ];

    // item
    #[PropertyTypeAttribute(ItemTransfer::class)]
    public const string ITEM = 'item';
    protected const string ITEM_DATA_NAME = 'ITEM';
    protected const int ITEM_DATA_INDEX = 0;

    public ?ItemTransfer $item {
        get => $this->_data[self::ITEM_DATA_INDEX];
        set => $this->_data[self::ITEM_DATA_INDEX] = $value;
    }

    // items
    #[CollectionPropertyTypeAttribute(ItemTransfer::class)]
    public const string ITEMS = 'items';
    protected const string ITEMS_DATA_NAME = 'ITEMS';
    protected const int ITEMS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,ItemTransfer> */
    public ArrayObject $items {
        get => $this->_data[self::ITEMS_DATA_INDEX];
        set => $this->_data[self::ITEMS_DATA_INDEX] = $value;
    }
}
