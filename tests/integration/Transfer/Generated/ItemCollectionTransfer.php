<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class ItemCollectionTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::ITEMS => self::ITEMS_DATA_NAME,
    ];

    // items
    #[CollectionPropertyTypeAttribute(ItemTransfer::class)]
    public const string ITEMS = 'items';
    protected const string ITEMS_DATA_NAME = 'ITEMS';
    protected const int ITEMS_DATA_INDEX = 0;

    /** @var \ArrayObject<int,ItemTransfer> */
    public ArrayObject $items {
        get => $this->getData(self::ITEMS_DATA_INDEX);
        set => $this->setData(self::ITEMS_DATA_INDEX, $value);
    }
}
