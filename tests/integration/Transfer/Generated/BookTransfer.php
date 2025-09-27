<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookData;
use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\BookmarkData;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/book-advanced.transfer.yml Definition file path.
 */
final class BookTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::BOOKMARKS_INDEX => self::BOOKMARKS,
        self::DATA_INDEX => self::DATA,
    ];

    // bookmarks
    #[CollectionPropertyTypeAttribute(BookmarkData::class)]
    public const string BOOKMARKS = 'bookmarks';
    private const int BOOKMARKS_INDEX = 0;

    /** @var \ArrayObject<int,TransferInterface&BookmarkData> */
    public ArrayObject $bookmarks {
        get => $this->getData(self::BOOKMARKS_INDEX);
        set => $this->setData(self::BOOKMARKS_INDEX, $value);
    }

    // data
    #[PropertyTypeAttribute(BookData::class)]
    public const string DATA = 'data';
    private const int DATA_INDEX = 1;

    public TransferInterface&BookData $data {
        get => $this->getData(self::DATA_INDEX);
        set => $this->setData(self::DATA_INDEX, $value);
    }
}
