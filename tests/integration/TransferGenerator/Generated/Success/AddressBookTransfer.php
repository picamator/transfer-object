<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use ArrayObject;
use Picamator\Tests\Integration\TransferObject\TransferGenerator\Enum\AddressLabelEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class AddressBookTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::ADDRESSES => self::ADDRESSES_DATA_NAME,
        self::CATEGORIES => self::CATEGORIES_DATA_NAME,
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
        get => $this->getData(self::ADDRESSES_DATA_INDEX);
        set => $this->setData(self::ADDRESSES_DATA_INDEX, $value);
    }

    // categories
    #[ArrayPropertyTypeAttribute]
    public const string CATEGORIES = 'categories';
    protected const string CATEGORIES_DATA_NAME = 'CATEGORIES';
    protected const int CATEGORIES_DATA_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $categories {
        get => $this->getData(self::CATEGORIES_DATA_INDEX);
        set => $this->setData(self::CATEGORIES_DATA_INDEX, $value);
    }

    // label
    #[EnumPropertyTypeAttribute(AddressLabelEnum::class)]
    public const string LABEL = 'label';
    protected const string LABEL_DATA_NAME = 'LABEL';
    protected const int LABEL_DATA_INDEX = 2;

    public ?AddressLabelEnum $label {
        get => $this->getData(self::LABEL_DATA_INDEX);
        set => $this->setData(self::LABEL_DATA_INDEX, $value);
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 3;

    public ?string $name {
        get => $this->getData(self::NAME_DATA_INDEX);
        set => $this->setData(self::NAME_DATA_INDEX, $value);
    }

    // uuid
    public const string UUID = 'uuid';
    protected const string UUID_DATA_NAME = 'UUID';
    protected const int UUID_DATA_INDEX = 4;

    public ?string $uuid {
        get => $this->getData(self::UUID_DATA_INDEX);
        set => $this->setData(self::UUID_DATA_INDEX, $value);
    }
}
