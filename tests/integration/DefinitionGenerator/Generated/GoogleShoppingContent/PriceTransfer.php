<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\GoogleShoppingContent;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class PriceTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CURRENCY => self::CURRENCY_DATA_NAME,
        self::VALUE => self::VALUE_DATA_NAME,
    ];

    // currency
    public const string CURRENCY = 'currency';
    protected const string CURRENCY_DATA_NAME = 'CURRENCY';
    protected const int CURRENCY_DATA_INDEX = 0;

    public ?string $currency {
        get => $this->getData(self::CURRENCY_DATA_INDEX);
        set => $this->setData(self::CURRENCY_DATA_INDEX, $value);
    }

    // value
    public const string VALUE = 'value';
    protected const string VALUE_DATA_NAME = 'VALUE';
    protected const int VALUE_DATA_INDEX = 1;

    public ?string $value {
        get => $this->getData(self::VALUE_DATA_INDEX);
        set => $this->setData(self::VALUE_DATA_INDEX, $value);
    }
}
