<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
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
        get => $this->getData(self::CUSTOMER_DATA_INDEX);
        set => $this->setData(self::CUSTOMER_DATA_INDEX, $value);
    }

    // merchants
    #[CollectionPropertyTypeAttribute(MerchantTransfer::class)]
    public const string MERCHANTS = 'merchants';
    protected const string MERCHANTS_DATA_NAME = 'MERCHANTS';
    protected const int MERCHANTS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,MerchantTransfer> */
    public ArrayObject $merchants {
        get => $this->getData(self::MERCHANTS_DATA_INDEX);
        set => $this->setData(self::MERCHANTS_DATA_INDEX, $value);
    }
}
