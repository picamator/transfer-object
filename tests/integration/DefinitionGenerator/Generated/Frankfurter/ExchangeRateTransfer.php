<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Frankfurter;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/frankfurter-dev-v1/definition/exchangeRate.transfer.yml Definition file path.
 */
final class ExchangeRateTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::AMOUNT => self::AMOUNT_DATA_NAME,
        self::BASE => self::BASE_DATA_NAME,
        self::DATE => self::DATE_DATA_NAME,
        self::RATES => self::RATES_DATA_NAME,
    ];

    // amount
    public const string AMOUNT = 'amount';
    protected const string AMOUNT_DATA_NAME = 'AMOUNT';
    protected const int AMOUNT_DATA_INDEX = 0;

    public ?int $amount {
        get => $this->_data[self::AMOUNT_DATA_INDEX];
        set => $this->_data[self::AMOUNT_DATA_INDEX] = $value;
    }

    // base
    public const string BASE = 'base';
    protected const string BASE_DATA_NAME = 'BASE';
    protected const int BASE_DATA_INDEX = 1;

    public ?string $base {
        get => $this->_data[self::BASE_DATA_INDEX];
        set => $this->_data[self::BASE_DATA_INDEX] = $value;
    }

    // date
    public const string DATE = 'date';
    protected const string DATE_DATA_NAME = 'DATE';
    protected const int DATE_DATA_INDEX = 2;

    public ?string $date {
        get => $this->_data[self::DATE_DATA_INDEX];
        set => $this->_data[self::DATE_DATA_INDEX] = $value;
    }

    // rates
    #[PropertyTypeAttribute(RatesTransfer::class)]
    public const string RATES = 'rates';
    protected const string RATES_DATA_NAME = 'RATES';
    protected const int RATES_DATA_INDEX = 3;

    public ?RatesTransfer $rates {
        get => $this->_data[self::RATES_DATA_INDEX];
        set => $this->_data[self::RATES_DATA_INDEX] = $value;
    }
}
