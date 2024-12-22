<?php

declare(strict_types=1);

namespace Picamator\Doc\TransferObject\Samples\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class AgentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CUSTOMER => self::CUSTOMER_DATA_NAME,
        self::MERCHANTS => self::MERCHANTS_DATA_NAME,
    ];

    // customer
    #[PropertyTypeAttribute(CustomerTransfer::class)]
    public const string CUSTOMER = 'customer';
    protected const string CUSTOMER_DATA_NAME = 'CUSTOMER';
    protected const int CUSTOMER_DATA_INDEX = 0;

    public ?CustomerTransfer $customer {
        get => $this->_data[self::CUSTOMER_DATA_INDEX];
        set => $this->_data[self::CUSTOMER_DATA_INDEX] = $value;
    }

    // merchants
    #[CollectionPropertyTypeAttribute(MerchantTransfer::class)]
    public const string MERCHANTS = 'merchants';
    protected const string MERCHANTS_DATA_NAME = 'MERCHANTS';
    protected const int MERCHANTS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,MerchantTransfer> */
    public ArrayObject $merchants {
        get => $this->_data[self::MERCHANTS_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::MERCHANTS_DATA_INDEX] = $value;
    }
}
