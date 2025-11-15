<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\AdvancedTransferGenerator;

use Picamator\Examples\TransferObject\Advanced\AddressData;
use Picamator\Examples\TransferObject\Advanced\CredentialsData;
use Picamator\Examples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/advanced-transfer-generator/definition/advanced-customer.transfer.yml Definition file path.
 */
final class AdvancedCustomerTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::ADDRESS => self::ADDRESS_INDEX,
        self::CREDENTIALS => self::CREDENTIALS_INDEX,
        self::CUSTOMER => self::CUSTOMER_INDEX,
    ];

    // address
    #[TransferTransformerAttribute(AddressData::class)]
    public const string ADDRESS = 'address';
    private const int ADDRESS_INDEX = 0;

    public TransferInterface&AddressData $address {
        get => $this->getData(self::ADDRESS_INDEX);
        set => $this->setData(self::ADDRESS_INDEX, $value);
    }

    // credentials
    #[TransferTransformerAttribute(CredentialsData::class)]
    public const string CREDENTIALS = 'credentials';
    private const int CREDENTIALS_INDEX = 1;

    public TransferInterface&CredentialsData $credentials {
        get => $this->getData(self::CREDENTIALS_INDEX);
        set => $this->setData(self::CREDENTIALS_INDEX, $value);
    }

    // customer
    #[TransferTransformerAttribute(CustomerTransfer::class)]
    public const string CUSTOMER = 'customer';
    private const int CUSTOMER_INDEX = 2;

    public TransferInterface&CustomerTransfer $customer {
        get => $this->getData(self::CUSTOMER_INDEX);
        set => $this->setData(self::CUSTOMER_INDEX, $value);
    }
}
