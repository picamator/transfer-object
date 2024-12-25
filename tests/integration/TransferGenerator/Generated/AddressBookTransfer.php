<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated;

use ArrayObject;
use Picamator\Tests\Integration\TransferObject\TransferGenerator\Enum\AddressLabelEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class AddressBookTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::ADDRESSES => self::ADDRESSES_DATA_NAME,
        self::CATEFORIES => self::CATEFORIES_DATA_NAME,
        self::LABEL => self::LABEL_DATA_NAME,
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

    // catefories
    public const string CATEFORIES = 'catefories';
    protected const string CATEFORIES_DATA_NAME = 'CATEFORIES';
    protected const int CATEFORIES_DATA_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $catefories {
        get => $this->_data[self::CATEFORIES_DATA_INDEX] ?? [];
        set => $this->_data[self::CATEFORIES_DATA_INDEX] = $value;
    }

    // label
    #[EnumPropertyTypeAttribute(AddressLabelEnum::class)]
    public const string LABEL = 'label';
    protected const string LABEL_DATA_NAME = 'LABEL';
    protected const int LABEL_DATA_INDEX = 2;

    public ?AddressLabelEnum $label {
        get => $this->_data[self::LABEL_DATA_INDEX];
        set => $this->_data[self::LABEL_DATA_INDEX] = $value;
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 3;

    public ?string $name {
        get => $this->_data[self::NAME_DATA_INDEX];
        set => $this->_data[self::NAME_DATA_INDEX] = $value;
    }

    // uuid
    public const string UUID = 'uuid';
    protected const string UUID_DATA_NAME = 'UUID';
    protected const int UUID_DATA_INDEX = 4;

    public ?string $uuid {
        get => $this->_data[self::UUID_DATA_INDEX];
        set => $this->_data[self::UUID_DATA_INDEX] = $value;
    }
}
