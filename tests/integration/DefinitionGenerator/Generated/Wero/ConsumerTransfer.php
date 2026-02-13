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
final class ConsumerTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::COUNTRY_PROP => self::COUNTRY_INDEX,
    ];

    // country
    public const string COUNTRY_PROP = 'country';
    private const int COUNTRY_INDEX = 0;

    public ?string $country {
        get => $this->getData(self::COUNTRY_INDEX);
        set {
            $this->setData(self::COUNTRY_INDEX, $value);
        }
    }
}
