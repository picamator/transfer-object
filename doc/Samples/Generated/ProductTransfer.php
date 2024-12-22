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
final class ProductTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 9;

    protected const array META_DATA = [
        self::CURRENCY => self::CURRENCY_DATA_NAME,
        self::DELIVERY_OPTIONS => self::DELIVERY_OPTIONS_DATA_NAME,
        self::DETAILS => self::DETAILS_DATA_NAME,
        self::IS_DISCOUNTED => self::IS_DISCOUNTED_DATA_NAME,
        self::NAME => self::NAME_DATA_NAME,
        self::PRICE => self::PRICE_DATA_NAME,
        self::SKU => self::SKU_DATA_NAME,
        self::STOCK => self::STOCK_DATA_NAME,
        self::STORES => self::STORES_DATA_NAME,
    ];

    // currency
    public const string CURRENCY = 'currency';
    protected const string CURRENCY_DATA_NAME = 'CURRENCY';
    protected const int CURRENCY_DATA_INDEX = 0;

    public ?string $currency {
        get => $this->_data[self::CURRENCY_DATA_INDEX];
        set => $this->_data[self::CURRENCY_DATA_INDEX] = $value;
    }

    // deliveryOptions
    #[CollectionPropertyTypeAttribute(DeliveryOptionsTransfer::class)]
    public const string DELIVERY_OPTIONS = 'deliveryOptions';
    protected const string DELIVERY_OPTIONS_DATA_NAME = 'DELIVERY_OPTIONS';
    protected const int DELIVERY_OPTIONS_DATA_INDEX = 1;

    /** @var \ArrayObject<int,DeliveryOptionsTransfer> */
    public ArrayObject $deliveryOptions {
        get => $this->_data[self::DELIVERY_OPTIONS_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::DELIVERY_OPTIONS_DATA_INDEX] = $value;
    }

    // details
    #[PropertyTypeAttribute(DetailsTransfer::class)]
    public const string DETAILS = 'details';
    protected const string DETAILS_DATA_NAME = 'DETAILS';
    protected const int DETAILS_DATA_INDEX = 2;

    public ?DetailsTransfer $details {
        get => $this->_data[self::DETAILS_DATA_INDEX];
        set => $this->_data[self::DETAILS_DATA_INDEX] = $value;
    }

    // isDiscounted
    public const string IS_DISCOUNTED = 'isDiscounted';
    protected const string IS_DISCOUNTED_DATA_NAME = 'IS_DISCOUNTED';
    protected const int IS_DISCOUNTED_DATA_INDEX = 3;

    public ?bool $isDiscounted {
        get => $this->_data[self::IS_DISCOUNTED_DATA_INDEX];
        set => $this->_data[self::IS_DISCOUNTED_DATA_INDEX] = $value;
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 4;

    public ?string $name {
        get => $this->_data[self::NAME_DATA_INDEX];
        set => $this->_data[self::NAME_DATA_INDEX] = $value;
    }

    // price
    public const string PRICE = 'price';
    protected const string PRICE_DATA_NAME = 'PRICE';
    protected const int PRICE_DATA_INDEX = 5;

    public ?float $price {
        get => $this->_data[self::PRICE_DATA_INDEX];
        set => $this->_data[self::PRICE_DATA_INDEX] = $value;
    }

    // sku
    public const string SKU = 'sku';
    protected const string SKU_DATA_NAME = 'SKU';
    protected const int SKU_DATA_INDEX = 6;

    public ?string $sku {
        get => $this->_data[self::SKU_DATA_INDEX];
        set => $this->_data[self::SKU_DATA_INDEX] = $value;
    }

    // stock
    public const string STOCK = 'stock';
    protected const string STOCK_DATA_NAME = 'STOCK';
    protected const int STOCK_DATA_INDEX = 7;

    public ?int $stock {
        get => $this->_data[self::STOCK_DATA_INDEX];
        set => $this->_data[self::STOCK_DATA_INDEX] = $value;
    }

    // stores
    public const string STORES = 'stores';
    protected const string STORES_DATA_NAME = 'STORES';
    protected const int STORES_DATA_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $stores {
        get => $this->_data[self::STORES_DATA_INDEX] ?? [];
        set => $this->_data[self::STORES_DATA_INDEX] = $value;
    }
}
