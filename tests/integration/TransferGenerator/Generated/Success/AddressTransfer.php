<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/TransferGenerator/data/config/success/definition/address.transfer.yml Definition file path.
 */
final class AddressTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 10;

    protected const array META_DATA = [
        self::ADDRESS1_INDEX => self::ADDRESS1,
        self::ADDRESS2_INDEX => self::ADDRESS2,
        self::ADDRESS3_INDEX => self::ADDRESS3,
        self::COUNTRY_INDEX => self::COUNTRY,
        self::FIRST_NAME_INDEX => self::FIRST_NAME,
        self::IS_ACTIVE_INDEX => self::IS_ACTIVE,
        self::LAST_NAME_INDEX => self::LAST_NAME,
        self::PHONE_INDEX => self::PHONE,
        self::UUID_INDEX => self::UUID,
        self::ZIP_CODE_INDEX => self::ZIP_CODE,
    ];

    // address1
    public const string ADDRESS1 = 'address1';
    private const int ADDRESS1_INDEX = 0;

    public ?string $address1 {
        get => $this->getData(self::ADDRESS1_INDEX);
        set => $this->setData(self::ADDRESS1_INDEX, $value);
    }

    // address2
    public const string ADDRESS2 = 'address2';
    private const int ADDRESS2_INDEX = 1;

    public ?string $address2 {
        get => $this->getData(self::ADDRESS2_INDEX);
        set => $this->setData(self::ADDRESS2_INDEX, $value);
    }

    // address3
    public const string ADDRESS3 = 'address3';
    private const int ADDRESS3_INDEX = 2;

    public ?string $address3 {
        get => $this->getData(self::ADDRESS3_INDEX);
        set => $this->setData(self::ADDRESS3_INDEX, $value);
    }

    // country
    #[CollectionPropertyTypeAttribute(CountryTransfer::class)]
    public const string COUNTRY = 'country';
    private const int COUNTRY_INDEX = 3;

    /** @var \ArrayObject<int,CountryTransfer> */
    public ArrayObject $country {
        get => $this->getData(self::COUNTRY_INDEX);
        set => $this->setData(self::COUNTRY_INDEX, $value);
    }

    // firstName
    public const string FIRST_NAME = 'firstName';
    private const int FIRST_NAME_INDEX = 4;

    public ?string $firstName {
        get => $this->getData(self::FIRST_NAME_INDEX);
        set => $this->setData(self::FIRST_NAME_INDEX, $value);
    }

    // isActive
    public const string IS_ACTIVE = 'isActive';
    private const int IS_ACTIVE_INDEX = 5;

    public ?bool $isActive {
        get => $this->getData(self::IS_ACTIVE_INDEX);
        set => $this->setData(self::IS_ACTIVE_INDEX, $value);
    }

    // lastName
    public const string LAST_NAME = 'lastName';
    private const int LAST_NAME_INDEX = 6;

    public ?string $lastName {
        get => $this->getData(self::LAST_NAME_INDEX);
        set => $this->setData(self::LAST_NAME_INDEX, $value);
    }

    // phone
    public const string PHONE = 'phone';
    private const int PHONE_INDEX = 7;

    public ?string $phone {
        get => $this->getData(self::PHONE_INDEX);
        set => $this->setData(self::PHONE_INDEX, $value);
    }

    // uuid
    public const string UUID = 'uuid';
    private const int UUID_INDEX = 8;

    public ?string $uuid {
        get => $this->getData(self::UUID_INDEX);
        set => $this->setData(self::UUID_INDEX, $value);
    }

    // zipCode
    public const string ZIP_CODE = 'zipCode';
    private const int ZIP_CODE_INDEX = 9;

    public ?string $zipCode {
        get => $this->getData(self::ZIP_CODE_INDEX);
        set => $this->setData(self::ZIP_CODE_INDEX, $value);
    }
}
