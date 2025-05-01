<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\AdvancedTransferGenerator;

use Picamator\Doc\Samples\TransferObject\Advanced\AddressData;
use Picamator\Doc\Samples\TransferObject\Advanced\CredentialsData;
use Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator\CustomerTransfer;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /doc/samples/config/advanced-transfer-generator/definition/advanced-customer.transfer.yml Definition file path.
 */
final class AdvancedCustomerTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::ADDRESS => self::ADDRESS_DATA_NAME,
        self::CREDENTIALS => self::CREDENTIALS_DATA_NAME,
        self::CUSTOMER => self::CUSTOMER_DATA_NAME,
    ];

    // address
    #[PropertyTypeAttribute(AddressData::class)]
    public const string ADDRESS = 'address';
    protected const string ADDRESS_DATA_NAME = 'ADDRESS';
    protected const int ADDRESS_DATA_INDEX = 0;

    public TransferInterface&AddressData $address {
        get => $this->getData(self::ADDRESS_DATA_INDEX);
        set => $this->setData(self::ADDRESS_DATA_INDEX, $value);
    }

    // credentials
    #[PropertyTypeAttribute(CredentialsData::class)]
    public const string CREDENTIALS = 'credentials';
    protected const string CREDENTIALS_DATA_NAME = 'CREDENTIALS';
    protected const int CREDENTIALS_DATA_INDEX = 1;

    public TransferInterface&CredentialsData $credentials {
        get => $this->getData(self::CREDENTIALS_DATA_INDEX);
        set => $this->setData(self::CREDENTIALS_DATA_INDEX, $value);
    }

    // customer
    #[PropertyTypeAttribute(CustomerTransfer::class)]
    public const string CUSTOMER = 'customer';
    protected const string CUSTOMER_DATA_NAME = 'CUSTOMER';
    protected const int CUSTOMER_DATA_INDEX = 2;

    public TransferInterface&CustomerTransfer $customer {
        get => $this->getData(self::CUSTOMER_DATA_INDEX);
        set => $this->setData(self::CUSTOMER_DATA_INDEX, $value);
    }
}
