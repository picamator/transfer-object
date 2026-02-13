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
final class SettingsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::RETURN_URL_PROP => self::RETURN_URL_INDEX,
    ];

    // returnUrl
    public const string RETURN_URL_PROP = 'returnUrl';
    private const int RETURN_URL_INDEX = 0;

    public ?string $returnUrl {
        get => $this->getData(self::RETURN_URL_INDEX);
        set {
            $this->setData(self::RETURN_URL_INDEX, $value);
        }
    }
}
