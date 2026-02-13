<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Wero;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
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
final class PaymentChargesTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::AMOUNT_PROP => self::AMOUNT_INDEX,
        self::AUTHENTICATION_SETTINGS_PROP => self::AUTHENTICATION_SETTINGS_INDEX,
        self::CONSUMER_PROP => self::CONSUMER_INDEX,
        self::PAYMENT_METHOD_PROP => self::PAYMENT_METHOD_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::AUTHENTICATION_SETTINGS_PROP => 'AUTHENTICATION_SETTINGS_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::AMOUNT_PROP => 'AMOUNT_PROP',
        self::AUTHENTICATION_SETTINGS_PROP => 'AUTHENTICATION_SETTINGS_PROP',
        self::CONSUMER_PROP => 'CONSUMER_PROP',
    ];

    // amount
    #[TransferTransformerAttribute(AmountTransfer::class)]
    public const string AMOUNT_PROP = 'amount';
    private const int AMOUNT_INDEX = 0;

    public ?AmountTransfer $amount {
        get => $this->getData(self::AMOUNT_INDEX);
        set {
            $this->setData(self::AMOUNT_INDEX, $value);
        }
    }

    // authenticationSettings
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(AuthenticationSettingsTransfer::class)]
    public const string AUTHENTICATION_SETTINGS_PROP = 'authenticationSettings';
    private const int AUTHENTICATION_SETTINGS_INDEX = 1;

    /** @var \ArrayObject<int,AuthenticationSettingsTransfer> */
    public ArrayObject $authenticationSettings {
        get => $this->getData(self::AUTHENTICATION_SETTINGS_INDEX);
        set {
            $this->setData(self::AUTHENTICATION_SETTINGS_INDEX, $value);
        }
    }

    // consumer
    #[TransferTransformerAttribute(ConsumerTransfer::class)]
    public const string CONSUMER_PROP = 'consumer';
    private const int CONSUMER_INDEX = 2;

    public ?ConsumerTransfer $consumer {
        get => $this->getData(self::CONSUMER_INDEX);
        set {
            $this->setData(self::CONSUMER_INDEX, $value);
        }
    }

    // paymentMethod
    public const string PAYMENT_METHOD_PROP = 'paymentMethod';
    private const int PAYMENT_METHOD_INDEX = 3;

    public ?string $paymentMethod {
        get => $this->getData(self::PAYMENT_METHOD_INDEX);
        set {
            $this->setData(self::PAYMENT_METHOD_INDEX, $value);
        }
    }
}
