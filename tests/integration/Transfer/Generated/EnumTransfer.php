<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use Picamator\Tests\Integration\TransferObject\Transfer\Enum\CountryEnum;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\YesNoEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\EnumTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/enum.transfer.yml Definition file path.
 */
final class EnumTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::COUNTRY_PROP => self::COUNTRY_INDEX,
        self::IS_ACTIVE_PROP => self::IS_ACTIVE_INDEX,
    ];

    protected const array META_TRANSFORMERS = [
        self::COUNTRY_PROP => 'COUNTRY_PROP',
        self::IS_ACTIVE_PROP => 'IS_ACTIVE_PROP',
    ];

    // country
    #[EnumTransformerAttribute(CountryEnum::class)]
    public const string COUNTRY_PROP = 'country';
    private const int COUNTRY_INDEX = 0;

    public ?CountryEnum $country {
        get => $this->getData(self::COUNTRY_INDEX);
        set {
            $this->setData(self::COUNTRY_INDEX, $value);
        }
    }

    // isActive
    #[EnumTransformerAttribute(YesNoEnum::class)]
    public const string IS_ACTIVE_PROP = 'isActive';
    private const int IS_ACTIVE_INDEX = 1;

    public ?YesNoEnum $isActive {
        get => $this->getData(self::IS_ACTIVE_INDEX);
        set {
            $this->setData(self::IS_ACTIVE_INDEX, $value);
        }
    }
}
