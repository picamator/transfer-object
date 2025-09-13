<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\TransferGenerator;

use Picamator\Examples\TransferObject\Enum\CountryEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/transfer-generator/definition/merchant.transfer.yml Definition file path.
 */
final class MerchantTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::COUNTRY_INDEX => self::COUNTRY,
        self::IS_ACTIVE_INDEX => self::IS_ACTIVE,
        self::MERCHANT_REFERENCE_INDEX => self::MERCHANT_REFERENCE,
    ];

    // country
    #[EnumPropertyTypeAttribute(CountryEnum::class)]
    public const string COUNTRY = 'country';
    protected const int COUNTRY_INDEX = 0;

    public CountryEnum $country {
        get => $this->getData(self::COUNTRY_INDEX);
        set => $this->setData(self::COUNTRY_INDEX, $value);
    }

    // isActive
    public const string IS_ACTIVE = 'isActive';
    protected const int IS_ACTIVE_INDEX = 1;

    public bool $isActive {
        get => $this->getData(self::IS_ACTIVE_INDEX);
        set => $this->setData(self::IS_ACTIVE_INDEX, $value);
    }

    // merchantReference
    public const string MERCHANT_REFERENCE = 'merchantReference';
    protected const int MERCHANT_REFERENCE_INDEX = 2;

    public string $merchantReference {
        get => $this->getData(self::MERCHANT_REFERENCE_INDEX);
        set => $this->setData(self::MERCHANT_REFERENCE_INDEX, $value);
    }
}
