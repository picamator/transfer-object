<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Wero;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/wero-payment-charges-v1/definition/paymentCharges.transfer.yml Definition file path.
 */
final class AmountTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CURRENCY_PROP => self::CURRENCY_INDEX,
        self::VALUE_PROP => self::VALUE_INDEX,
    ];

    // currency
    public const string CURRENCY_PROP = 'currency';
    private const int CURRENCY_INDEX = 0;

    public ?string $currency {
        get => $this->getData(self::CURRENCY_INDEX);
        set {
            $this->setData(self::CURRENCY_INDEX, $value);
        }
    }

    // value
    public const string VALUE_PROP = 'value';
    private const int VALUE_INDEX = 1;

    public ?int $value {
        get => $this->getData(self::VALUE_INDEX);
        set {
            $this->setData(self::VALUE_INDEX, $value);
        }
    }
}
