<?php declare(strict_types = 1);

namespace Picamator\Tests\Integration\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class AddressTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 10;

    protected const array META_DATA = [
        self::ADDRESS1 => self::ADDRESS1_DATA_NAME,
        self::ADDRESS2 => self::ADDRESS2_DATA_NAME,
        self::ADDRESS3 => self::ADDRESS3_DATA_NAME,
        self::COUNTRY => self::COUNTRY_DATA_NAME,
        self::FIRST_NAME => self::FIRST_NAME_DATA_NAME,
        self::IS_ACTIVE => self::IS_ACTIVE_DATA_NAME,
        self::LAST_NAME => self::LAST_NAME_DATA_NAME,
        self::PHONE => self::PHONE_DATA_NAME,
        self::UUID => self::UUID_DATA_NAME,
        self::ZIP_CODE => self::ZIP_CODE_DATA_NAME,
    ];

    // address1
    public const string ADDRESS1 = 'address1';
    protected const string ADDRESS1_DATA_NAME = 'ADDRESS1';
    protected const int ADDRESS1_DATA_INDEX = 0;

    public ?string $address1 {
        get => $this->_data[self::ADDRESS1_DATA_INDEX];
        set => $this->_data[self::ADDRESS1_DATA_INDEX] = $value;
    }

    // address2
    public const string ADDRESS2 = 'address2';
    protected const string ADDRESS2_DATA_NAME = 'ADDRESS2';
    protected const int ADDRESS2_DATA_INDEX = 1;

    public ?string $address2 {
        get => $this->_data[self::ADDRESS2_DATA_INDEX];
        set => $this->_data[self::ADDRESS2_DATA_INDEX] = $value;
    }

    // address3
    public const string ADDRESS3 = 'address3';
    protected const string ADDRESS3_DATA_NAME = 'ADDRESS3';
    protected const int ADDRESS3_DATA_INDEX = 2;

    public ?string $address3 {
        get => $this->_data[self::ADDRESS3_DATA_INDEX];
        set => $this->_data[self::ADDRESS3_DATA_INDEX] = $value;
    }

    // country
    #[CollectionPropertyTypeAttribute(CountryTransfer::class)]
    public const string COUNTRY = 'country';
    protected const string COUNTRY_DATA_NAME = 'COUNTRY';
    protected const int COUNTRY_DATA_INDEX = 3;

    /** @var \ArrayObject<int,CountryTransfer> */
    public ArrayObject $country {
        get => $this->_data[self::COUNTRY_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::COUNTRY_DATA_INDEX] = $value;
    }

    // firstName
    public const string FIRST_NAME = 'firstName';
    protected const string FIRST_NAME_DATA_NAME = 'FIRST_NAME';
    protected const int FIRST_NAME_DATA_INDEX = 4;

    public ?string $firstName {
        get => $this->_data[self::FIRST_NAME_DATA_INDEX];
        set => $this->_data[self::FIRST_NAME_DATA_INDEX] = $value;
    }

    // isActive
    public const string IS_ACTIVE = 'isActive';
    protected const string IS_ACTIVE_DATA_NAME = 'IS_ACTIVE';
    protected const int IS_ACTIVE_DATA_INDEX = 5;

    public ?bool $isActive {
        get => $this->_data[self::IS_ACTIVE_DATA_INDEX];
        set => $this->_data[self::IS_ACTIVE_DATA_INDEX] = $value;
    }

    // lastName
    public const string LAST_NAME = 'lastName';
    protected const string LAST_NAME_DATA_NAME = 'LAST_NAME';
    protected const int LAST_NAME_DATA_INDEX = 6;

    public ?string $lastName {
        get => $this->_data[self::LAST_NAME_DATA_INDEX];
        set => $this->_data[self::LAST_NAME_DATA_INDEX] = $value;
    }

    // phone
    public const string PHONE = 'phone';
    protected const string PHONE_DATA_NAME = 'PHONE';
    protected const int PHONE_DATA_INDEX = 7;

    public ?string $phone {
        get => $this->_data[self::PHONE_DATA_INDEX];
        set => $this->_data[self::PHONE_DATA_INDEX] = $value;
    }

    // uuid
    public const string UUID = 'uuid';
    protected const string UUID_DATA_NAME = 'UUID';
    protected const int UUID_DATA_INDEX = 8;

    public ?string $uuid {
        get => $this->_data[self::UUID_DATA_INDEX];
        set => $this->_data[self::UUID_DATA_INDEX] = $value;
    }

    // zipCode
    public const string ZIP_CODE = 'zipCode';
    protected const string ZIP_CODE_DATA_NAME = 'ZIP_CODE';
    protected const int ZIP_CODE_DATA_INDEX = 9;

    public ?string $zipCode {
        get => $this->_data[self::ZIP_CODE_DATA_INDEX];
        set => $this->_data[self::ZIP_CODE_DATA_INDEX] = $value;
    }
}