<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class ProductTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 12;

    protected const array META_DATA = [
        self::AVAILABILITIES => self::AVAILABILITIES_DATA_NAME,
        self::CURRENCY => self::CURRENCY_DATA_NAME,
        self::DELIVERY_OPTIONS => self::DELIVERY_OPTIONS_DATA_NAME,
        self::DETAILS => self::DETAILS_DATA_NAME,
        self::IS_DISCOUNTED => self::IS_DISCOUNTED_DATA_NAME,
        self::LABELS => self::LABELS_DATA_NAME,
        self::MEASUREMENT_UNIT => self::MEASUREMENT_UNIT_DATA_NAME,
        self::NAME => self::NAME_DATA_NAME,
        self::PRICE => self::PRICE_DATA_NAME,
        self::SKU => self::SKU_DATA_NAME,
        self::STOCK => self::STOCK_DATA_NAME,
        self::STORES => self::STORES_DATA_NAME,
    ];

    // availabilities
    #[CollectionPropertyTypeAttribute(AvailabilitiesTransfer::class)]
    public const string AVAILABILITIES = 'availabilities';
    protected const string AVAILABILITIES_DATA_NAME = 'AVAILABILITIES';
    protected const int AVAILABILITIES_DATA_INDEX = 0;

    /** @var \ArrayObject<int,AvailabilitiesTransfer> */
    public ArrayObject $availabilities {
        get => $this->getRequiredData(self::AVAILABILITIES_DATA_INDEX);
        set => $this->setData(self::AVAILABILITIES_DATA_INDEX, $value);
    }

    // currency
    public const string CURRENCY = 'currency';
    protected const string CURRENCY_DATA_NAME = 'CURRENCY';
    protected const int CURRENCY_DATA_INDEX = 1;

    public ?string $currency {
        get => $this->getData(self::CURRENCY_DATA_INDEX);
        set => $this->setData(self::CURRENCY_DATA_INDEX, $value);
    }

    // deliveryOptions
    #[CollectionPropertyTypeAttribute(DeliveryOptionsTransfer::class)]
    public const string DELIVERY_OPTIONS = 'deliveryOptions';
    protected const string DELIVERY_OPTIONS_DATA_NAME = 'DELIVERY_OPTIONS';
    protected const int DELIVERY_OPTIONS_DATA_INDEX = 2;

    /** @var \ArrayObject<int,DeliveryOptionsTransfer> */
    public ArrayObject $deliveryOptions {
        get => $this->getRequiredData(self::DELIVERY_OPTIONS_DATA_INDEX);
        set => $this->setData(self::DELIVERY_OPTIONS_DATA_INDEX, $value);
    }

    // details
    #[PropertyTypeAttribute(DetailsTransfer::class)]
    public const string DETAILS = 'details';
    protected const string DETAILS_DATA_NAME = 'DETAILS';
    protected const int DETAILS_DATA_INDEX = 3;

    public ?DetailsTransfer $details {
        get => $this->getData(self::DETAILS_DATA_INDEX);
        set => $this->setData(self::DETAILS_DATA_INDEX, $value);
    }

    // isDiscounted
    public const string IS_DISCOUNTED = 'isDiscounted';
    protected const string IS_DISCOUNTED_DATA_NAME = 'IS_DISCOUNTED';
    protected const int IS_DISCOUNTED_DATA_INDEX = 4;

    public ?bool $isDiscounted {
        get => $this->getData(self::IS_DISCOUNTED_DATA_INDEX);
        set => $this->setData(self::IS_DISCOUNTED_DATA_INDEX, $value);
    }

    // labels
    #[PropertyTypeAttribute(LabelsTransfer::class)]
    public const string LABELS = 'labels';
    protected const string LABELS_DATA_NAME = 'LABELS';
    protected const int LABELS_DATA_INDEX = 5;

    public ?LabelsTransfer $labels {
        get => $this->getData(self::LABELS_DATA_INDEX);
        set => $this->setData(self::LABELS_DATA_INDEX, $value);
    }

    // measurementUnit
    #[PropertyTypeAttribute(MeasurementUnitTransfer::class)]
    public const string MEASUREMENT_UNIT = 'measurementUnit';
    protected const string MEASUREMENT_UNIT_DATA_NAME = 'MEASUREMENT_UNIT';
    protected const int MEASUREMENT_UNIT_DATA_INDEX = 6;

    public ?MeasurementUnitTransfer $measurementUnit {
        get => $this->getData(self::MEASUREMENT_UNIT_DATA_INDEX);
        set => $this->setData(self::MEASUREMENT_UNIT_DATA_INDEX, $value);
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 7;

    public ?string $name {
        get => $this->getData(self::NAME_DATA_INDEX);
        set => $this->setData(self::NAME_DATA_INDEX, $value);
    }

    // price
    public const string PRICE = 'price';
    protected const string PRICE_DATA_NAME = 'PRICE';
    protected const int PRICE_DATA_INDEX = 8;

    public ?float $price {
        get => $this->getData(self::PRICE_DATA_INDEX);
        set => $this->setData(self::PRICE_DATA_INDEX, $value);
    }

    // sku
    public const string SKU = 'sku';
    protected const string SKU_DATA_NAME = 'SKU';
    protected const int SKU_DATA_INDEX = 9;

    public ?string $sku {
        get => $this->getData(self::SKU_DATA_INDEX);
        set => $this->setData(self::SKU_DATA_INDEX, $value);
    }

    // stock
    public const string STOCK = 'stock';
    protected const string STOCK_DATA_NAME = 'STOCK';
    protected const int STOCK_DATA_INDEX = 10;

    public ?int $stock {
        get => $this->getData(self::STOCK_DATA_INDEX);
        set => $this->setData(self::STOCK_DATA_INDEX, $value);
    }

    // stores
    #[ArrayPropertyTypeAttribute]
    public const string STORES = 'stores';
    protected const string STORES_DATA_NAME = 'STORES';
    protected const int STORES_DATA_INDEX = 11;

    /** @var array<int|string,mixed> */
    public array $stores {
        get => $this->getRequiredData(self::STORES_DATA_INDEX);
        set => $this->setData(self::STORES_DATA_INDEX, $value);
    }
}
