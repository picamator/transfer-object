<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\GoogleShoppingContent;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/google-shopping-content/definition/product.transfer.yml Definition file path.
 */
final class PriceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CURRENCY_INDEX => self::CURRENCY,
        self::VALUE_INDEX => self::VALUE,
    ];

    // currency
    public const string CURRENCY = 'currency';
    protected const int CURRENCY_INDEX = 0;

    public ?string $currency {
        get => $this->getData(self::CURRENCY_INDEX);
        set => $this->setData(self::CURRENCY_INDEX, $value);
    }

    // value
    public const string VALUE = 'value';
    protected const int VALUE_INDEX = 1;

    public ?string $value {
        get => $this->getData(self::VALUE_INDEX);
        set => $this->setData(self::VALUE_INDEX, $value);
    }
}
