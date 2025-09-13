<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\TransferGenerator;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/transfer-generator/definition/agent.transfer.yml Definition file path.
 */
final class AgentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CUSTOMER_INDEX => self::CUSTOMER,
        self::MERCHANTS_INDEX => self::MERCHANTS,
    ];

    // customer
    #[PropertyTypeAttribute(CustomerTransfer::class)]
    public const string CUSTOMER = 'customer';
    protected const int CUSTOMER_INDEX = 0;

    public ?CustomerTransfer $customer {
        get => $this->getData(self::CUSTOMER_INDEX);
        set => $this->setData(self::CUSTOMER_INDEX, $value);
    }

    // merchants
    #[CollectionPropertyTypeAttribute(MerchantTransfer::class)]
    public const string MERCHANTS = 'merchants';
    protected const int MERCHANTS_INDEX = 1;

    /** @var \ArrayObject<int,MerchantTransfer> */
    public ArrayObject $merchants {
        get => $this->getData(self::MERCHANTS_INDEX);
        set => $this->setData(self::MERCHANTS_INDEX, $value);
    }
}
