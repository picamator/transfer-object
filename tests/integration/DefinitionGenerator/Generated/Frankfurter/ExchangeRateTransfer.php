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
        self::AMOUNT_INDEX => self::AMOUNT,
        self::BASE_INDEX => self::BASE,
        self::DATE_INDEX => self::DATE,
        self::RATES_INDEX => self::RATES,
    ];

    // amount
    public const string AMOUNT = 'amount';
    private const int AMOUNT_INDEX = 0;

    public ?int $amount {
        get => $this->getData(self::AMOUNT_INDEX);
        set => $this->setData(self::AMOUNT_INDEX, $value);
    }

    // base
    public const string BASE = 'base';
    private const int BASE_INDEX = 1;

    public ?string $base {
        get => $this->getData(self::BASE_INDEX);
        set => $this->setData(self::BASE_INDEX, $value);
    }

    // date
    public const string DATE = 'date';
    private const int DATE_INDEX = 2;

    public ?string $date {
        get => $this->getData(self::DATE_INDEX);
        set => $this->setData(self::DATE_INDEX, $value);
    }

    // rates
    #[PropertyTypeAttribute(RatesTransfer::class)]
    public const string RATES = 'rates';
    private const int RATES_INDEX = 3;

    public ?RatesTransfer $rates {
        get => $this->getData(self::RATES_INDEX);
        set => $this->setData(self::RATES_INDEX, $value);
    }
}
