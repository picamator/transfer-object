<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\RequiredTransfer as RequiredAlias;
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
 * @see /tests/integration/Transfer/data/config/definition/namespace.transfer.yml Definition file path.
 */
final class NamespaceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ITEMS => self::ITEMS_DATA_NAME,
        self::REQUIRED => self::REQUIRED_DATA_NAME,
    ];

    // items
    #[CollectionPropertyTypeAttribute(ItemTransfer::class)]
    public const string ITEMS = 'items';
    protected const string ITEMS_DATA_NAME = 'ITEMS';
    protected const int ITEMS_DATA_INDEX = 0;

    /** @var \ArrayObject<int,TransferInterface&ItemTransfer> */
    public ArrayObject $items {
        get => $this->getData(self::ITEMS_DATA_INDEX);
        set => $this->setData(self::ITEMS_DATA_INDEX, $value);
    }

    // required
    #[PropertyTypeAttribute(RequiredAlias::class)]
    public const string REQUIRED = 'required';
    protected const string REQUIRED_DATA_NAME = 'REQUIRED';
    protected const int REQUIRED_DATA_INDEX = 1;

    public TransferInterface&RequiredAlias $required {
        get => $this->getData(self::REQUIRED_DATA_INDEX);
        set => $this->setData(self::REQUIRED_DATA_INDEX, $value);
    }
}
