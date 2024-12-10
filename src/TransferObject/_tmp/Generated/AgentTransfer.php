<?php declare(strict_types = 1);

namespace Picamator\TransferObject\_tmp\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

final class AgentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CUSTOMER => self::CUSTOMER_DATA_NAME,
        self::MERCHANTS => self::MERCHANTS_DATA_NAME,
    ];

    #[PropertyTypeAttribute(CustomerTransfer::class)]
    public const string CUSTOMER = 'customer';
    protected const string CUSTOMER_DATA_NAME = 'CUSTOMER';
    protected const int CUSTOMER_DATA_INDEX = 0;

    #[CollectionPropertyTypeAttribute(MerchantTransfer::class)]
    public const string MERCHANTS = 'merchants';
    protected const string MERCHANTS_DATA_NAME = 'MERCHANTS';
    protected const int MERCHANTS_DATA_INDEX = 1;

    public ?CustomerTransfer $customer {
        get => $this->data[self::CUSTOMER_DATA_INDEX];
        set => $this->data[self::CUSTOMER_DATA_INDEX] = $value;
    }

    /** @var \ArrayObject<MerchantTransfer>|null  */
    public ?ArrayObject $merchants {
        get => $this->data[self::MERCHANTS_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::MERCHANTS_DATA_INDEX] = $value;
    }
}
