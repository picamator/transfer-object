<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator;

use Picamator\Doc\Samples\TransferObject\Enum\CountryEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /doc/samples/config/transfer-generator/definition/merchant.transfer.yml Definition file path.
 */
final class MerchantTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::COUNTRY => self::COUNTRY_DATA_NAME,
        self::IS_ACTIVE => self::IS_ACTIVE_DATA_NAME,
        self::MERCHANT_REFERENCE => self::MERCHANT_REFERENCE_DATA_NAME,
    ];

    // country
    #[EnumPropertyTypeAttribute(CountryEnum::class)]
    public const string COUNTRY = 'country';
    protected const string COUNTRY_DATA_NAME = 'COUNTRY';
    protected const int COUNTRY_DATA_INDEX = 0;

    public CountryEnum $country {
        get => $this->_data[self::COUNTRY_DATA_INDEX];
        set => $this->_data[self::COUNTRY_DATA_INDEX] = $value;
    }

    // isActive
    public const string IS_ACTIVE = 'isActive';
    protected const string IS_ACTIVE_DATA_NAME = 'IS_ACTIVE';
    protected const int IS_ACTIVE_DATA_INDEX = 1;

    public bool $isActive {
        get => $this->_data[self::IS_ACTIVE_DATA_INDEX];
        set => $this->_data[self::IS_ACTIVE_DATA_INDEX] = $value;
    }

    // merchantReference
    public const string MERCHANT_REFERENCE = 'merchantReference';
    protected const string MERCHANT_REFERENCE_DATA_NAME = 'MERCHANT_REFERENCE';
    protected const int MERCHANT_REFERENCE_DATA_INDEX = 2;

    public string $merchantReference {
        get => $this->_data[self::MERCHANT_REFERENCE_DATA_INDEX];
        set => $this->_data[self::MERCHANT_REFERENCE_DATA_INDEX] = $value;
    }
}
