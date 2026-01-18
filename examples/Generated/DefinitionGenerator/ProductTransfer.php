<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\DefinitionGenerator;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
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
 * @see /examples/config/definition-generator/definition/product.transfer.yml Definition file path.
 */
final class ProductTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 12;

    protected const array META_DATA = [
        self::AVAILABILITIES_PROP => self::AVAILABILITIES_INDEX,
        self::CURRENCY_PROP => self::CURRENCY_INDEX,
        self::DELIVERY_OPTIONS_PROP => self::DELIVERY_OPTIONS_INDEX,
        self::DETAILS_PROP => self::DETAILS_INDEX,
        self::IS_DISCOUNTED_PROP => self::IS_DISCOUNTED_INDEX,
        self::LABELS_PROP => self::LABELS_INDEX,
        self::MEASUREMENT_UNIT_PROP => self::MEASUREMENT_UNIT_INDEX,
        self::NAME_PROP => self::NAME_INDEX,
        self::PRICE_PROP => self::PRICE_INDEX,
        self::SKU_PROP => self::SKU_INDEX,
        self::STOCK_PROP => self::STOCK_INDEX,
        self::STORES_PROP => self::STORES_INDEX,
    ];

    // availabilities
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(AvailabilitiesTransfer::class)]
    public const string AVAILABILITIES_PROP = 'availabilities';
    private const int AVAILABILITIES_INDEX = 0;

    /** @var \ArrayObject<int,AvailabilitiesTransfer> */
    public ArrayObject $availabilities {
        get => $this->getData(self::AVAILABILITIES_INDEX);
        set {
            $this->setData(self::AVAILABILITIES_INDEX, $value);
        }
    }

    // currency
    public const string CURRENCY_PROP = 'currency';
    private const int CURRENCY_INDEX = 1;

    public ?string $currency {
        get => $this->getData(self::CURRENCY_INDEX);
        set {
            $this->setData(self::CURRENCY_INDEX, $value);
        }
    }

    // deliveryOptions
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(DeliveryOptionsTransfer::class)]
    public const string DELIVERY_OPTIONS_PROP = 'deliveryOptions';
    private const int DELIVERY_OPTIONS_INDEX = 2;

    /** @var \ArrayObject<int,DeliveryOptionsTransfer> */
    public ArrayObject $deliveryOptions {
        get => $this->getData(self::DELIVERY_OPTIONS_INDEX);
        set {
            $this->setData(self::DELIVERY_OPTIONS_INDEX, $value);
        }
    }

    // details
    #[TransferTransformerAttribute(DetailsTransfer::class)]
    public const string DETAILS_PROP = 'details';
    private const int DETAILS_INDEX = 3;

    public ?DetailsTransfer $details {
        get => $this->getData(self::DETAILS_INDEX);
        set {
            $this->setData(self::DETAILS_INDEX, $value);
        }
    }

    // isDiscounted
    public const string IS_DISCOUNTED_PROP = 'isDiscounted';
    private const int IS_DISCOUNTED_INDEX = 4;

    public ?bool $isDiscounted {
        get => $this->getData(self::IS_DISCOUNTED_INDEX);
        set {
            $this->setData(self::IS_DISCOUNTED_INDEX, $value);
        }
    }

    // labels
    #[TransferTransformerAttribute(LabelsTransfer::class)]
    public const string LABELS_PROP = 'labels';
    private const int LABELS_INDEX = 5;

    public ?LabelsTransfer $labels {
        get => $this->getData(self::LABELS_INDEX);
        set {
            $this->setData(self::LABELS_INDEX, $value);
        }
    }

    // measurementUnit
    #[TransferTransformerAttribute(MeasurementUnitTransfer::class)]
    public const string MEASUREMENT_UNIT_PROP = 'measurementUnit';
    private const int MEASUREMENT_UNIT_INDEX = 6;

    public ?MeasurementUnitTransfer $measurementUnit {
        get => $this->getData(self::MEASUREMENT_UNIT_INDEX);
        set {
            $this->setData(self::MEASUREMENT_UNIT_INDEX, $value);
        }
    }

    // name
    public const string NAME_PROP = 'name';
    private const int NAME_INDEX = 7;

    public ?string $name {
        get => $this->getData(self::NAME_INDEX);
        set {
            $this->setData(self::NAME_INDEX, $value);
        }
    }

    // price
    public const string PRICE_PROP = 'price';
    private const int PRICE_INDEX = 8;

    public ?float $price {
        get => $this->getData(self::PRICE_INDEX);
        set {
            $this->setData(self::PRICE_INDEX, $value);
        }
    }

    // sku
    public const string SKU_PROP = 'sku';
    private const int SKU_INDEX = 9;

    public ?string $sku {
        get => $this->getData(self::SKU_INDEX);
        set {
            $this->setData(self::SKU_INDEX, $value);
        }
    }

    // stock
    public const string STOCK_PROP = 'stock';
    private const int STOCK_INDEX = 10;

    public ?int $stock {
        get => $this->getData(self::STOCK_INDEX);
        set {
            $this->setData(self::STOCK_INDEX, $value);
        }
    }

    // stores
    #[ArrayInitiatorAttribute]
    public const string STORES_PROP = 'stores';
    private const int STORES_INDEX = 11;

    /** @var array<int,string> */
    public array $stores {
        get => $this->getData(self::STORES_INDEX);
        set {
            $this->setData(self::STORES_INDEX, $value);
        }
    }
}
