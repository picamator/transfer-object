<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use ArrayObject;
use Picamator\Tests\Integration\TransferObject\TransferGenerator\Enum\AddressLabelEnum;
use Picamator\Tests\Integration\TransferObject\TransferGenerator\Enum\Alias\AddressLabelEnum as AliasAddressLabelEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/TransferGenerator/data/config/success/definition/address-book.transfer.yml Definition file path.
 */
final class AddressBookTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 6;

    protected const array META_DATA = [
        self::ADDRESSES_INDEX => self::ADDRESSES,
        self::CATEGORIES_INDEX => self::CATEGORIES,
        self::LABEL_INDEX => self::LABEL,
        self::LABEL_ALIAS_INDEX => self::LABEL_ALIAS,
        self::NAME_INDEX => self::NAME,
        self::UUID_INDEX => self::UUID,
    ];

    // addresses
    #[CollectionPropertyTypeAttribute(AddressTransfer::class)]
    public const string ADDRESSES = 'addresses';
    protected const int ADDRESSES_INDEX = 0;

    /** @var \ArrayObject<int,AddressTransfer> */
    public ArrayObject $addresses {
        get => $this->getData(self::ADDRESSES_INDEX);
        set => $this->setData(self::ADDRESSES_INDEX, $value);
    }

    // categories
    #[ArrayPropertyTypeAttribute]
    public const string CATEGORIES = 'categories';
    protected const int CATEGORIES_INDEX = 1;

    /** @var array<int|string,mixed> */
    public array $categories {
        get => $this->getData(self::CATEGORIES_INDEX);
        set => $this->setData(self::CATEGORIES_INDEX, $value);
    }

    // label
    #[EnumPropertyTypeAttribute(AddressLabelEnum::class)]
    public const string LABEL = 'label';
    protected const int LABEL_INDEX = 2;

    public ?AddressLabelEnum $label {
        get => $this->getData(self::LABEL_INDEX);
        set => $this->setData(self::LABEL_INDEX, $value);
    }

    // labelAlias
    #[EnumPropertyTypeAttribute(AliasAddressLabelEnum::class)]
    public const string LABEL_ALIAS = 'labelAlias';
    protected const int LABEL_ALIAS_INDEX = 3;

    public ?AliasAddressLabelEnum $labelAlias {
        get => $this->getData(self::LABEL_ALIAS_INDEX);
        set => $this->setData(self::LABEL_ALIAS_INDEX, $value);
    }

    // name
    public const string NAME = 'name';
    protected const int NAME_INDEX = 4;

    public ?string $name {
        get => $this->getData(self::NAME_INDEX);
        set => $this->setData(self::NAME_INDEX, $value);
    }

    // uuid
    public const string UUID = 'uuid';
    protected const int UUID_INDEX = 5;

    public ?string $uuid {
        get => $this->getData(self::UUID_INDEX);
        set => $this->setData(self::UUID_INDEX, $value);
    }
}
