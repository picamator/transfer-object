<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Wero;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/wero-payment-charges-v1/definition/paymentCharges.transfer.yml Definition file path.
 */
final class AuthenticationSettingsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::SETTINGS_PROP => self::SETTINGS_INDEX,
        self::TYPE_PROP => self::TYPE_INDEX,
    ];

    protected const array META_TRANSFORMERS = [
        self::SETTINGS_PROP => 'SETTINGS_PROP',
    ];

    // settings
    #[TransferTransformerAttribute(SettingsTransfer::class)]
    public const string SETTINGS_PROP = 'settings';
    private const int SETTINGS_INDEX = 0;

    public ?SettingsTransfer $settings {
        get => $this->getData(self::SETTINGS_INDEX);
        set {
            $this->setData(self::SETTINGS_INDEX, $value);
        }
    }

    // type
    public const string TYPE_PROP = 'type';
    private const int TYPE_INDEX = 1;

    public ?string $type {
        get => $this->getData(self::TYPE_INDEX);
        set {
            $this->setData(self::TYPE_INDEX, $value);
        }
    }
}
