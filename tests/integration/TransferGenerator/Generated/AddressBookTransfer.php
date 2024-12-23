<?php

declare(strict_types = 1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class AddressBookTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::ADDRESSES => self::ADDRESSES_DATA_NAME,
        self::LABELS => self::LABELS_DATA_NAME,
        self::NAME => self::NAME_DATA_NAME,
        self::UUID => self::UUID_DATA_NAME,
    ];

    // addresses
    #[CollectionPropertyTypeAttribute(AddressTransfer::class)]
    public const string ADDRESSES = 'addresses';
    protected const string ADDRESSES_DATA_NAME = 'ADDRESSES';
    protected const int ADDRESSES_DATA_INDEX = 0;

    /** @var \ArrayObject<int,AddressTransfer> */
    public ArrayObject $addresses {
        get => $this->_data[self::ADDRESSES_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::ADDRESSES_DATA_INDEX] = $value;
    }

    // labels
    public const string LABELS = 'labels';
    protected const string LABELS_DATA_NAME = 'LABELS';
    protected const int LABELS_DATA_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $labels {
        get => $this->_data[self::LABELS_DATA_INDEX] ?? [];
        set => $this->_data[self::LABELS_DATA_INDEX] = $value;
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 2;

    public ?string $name {
        get => $this->_data[self::NAME_DATA_INDEX];
        set => $this->_data[self::NAME_DATA_INDEX] = $value;
    }

    // uuid
    public const string UUID = 'uuid';
    protected const string UUID_DATA_NAME = 'UUID';
    protected const int UUID_DATA_INDEX = 3;

    public ?string $uuid {
        get => $this->_data[self::UUID_DATA_INDEX];
        set => $this->_data[self::UUID_DATA_INDEX] = $value;
    }
}
