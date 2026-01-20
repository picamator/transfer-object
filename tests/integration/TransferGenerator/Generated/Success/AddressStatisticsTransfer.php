<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayObjectTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/TransferGenerator/data/config/success/definition/address-statistics.transfer.yml Definition file path.
 */
final class AddressStatisticsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 7;

    protected const array META_DATA = [
        self::ADDRESS_BOOK_UUID_PROP => self::ADDRESS_BOOK_UUID_INDEX,
        self::ADDRESS_UUID_PROP => self::ADDRESS_UUID_INDEX,
        self::IS_ACTIVE_PROP => self::IS_ACTIVE_INDEX,
        self::IS_BLOCKED_PROP => self::IS_BLOCKED_INDEX,
        self::ORDER_AVERAGE_PROP => self::ORDER_AVERAGE_INDEX,
        self::ORDER_COUNT_PROP => self::ORDER_COUNT_INDEX,
        self::ORDER_REFERENCES_PROP => self::ORDER_REFERENCES_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::ORDER_REFERENCES_PROP => 'ORDER_REFERENCES_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::ORDER_REFERENCES_PROP => 'ORDER_REFERENCES_PROP',
    ];

    // addressBookUuid
    public const string ADDRESS_BOOK_UUID_PROP = 'addressBookUuid';
    private const int ADDRESS_BOOK_UUID_INDEX = 0;

    public ?string $addressBookUuid {
        get => $this->getData(self::ADDRESS_BOOK_UUID_INDEX);
        set {
            $this->setData(self::ADDRESS_BOOK_UUID_INDEX, $value);
        }
    }

    // addressUuid
    public const string ADDRESS_UUID_PROP = 'addressUuid';
    private const int ADDRESS_UUID_INDEX = 1;

    public ?string $addressUuid {
        get => $this->getData(self::ADDRESS_UUID_INDEX);
        set {
            $this->setData(self::ADDRESS_UUID_INDEX, $value);
        }
    }

    // isActive
    public const string IS_ACTIVE_PROP = 'isActive';
    private const int IS_ACTIVE_INDEX = 2;

    public ?true $isActive {
        get => $this->getData(self::IS_ACTIVE_INDEX);
        set {
            $this->setData(self::IS_ACTIVE_INDEX, $value);
        }
    }

    // isBlocked
    public const string IS_BLOCKED_PROP = 'isBlocked';
    private const int IS_BLOCKED_INDEX = 3;

    public ?false $isBlocked {
        get => $this->getData(self::IS_BLOCKED_INDEX);
        set {
            $this->setData(self::IS_BLOCKED_INDEX, $value);
        }
    }

    // orderAverage
    public const string ORDER_AVERAGE_PROP = 'orderAverage';
    private const int ORDER_AVERAGE_INDEX = 4;

    public ?float $orderAverage {
        get => $this->getData(self::ORDER_AVERAGE_INDEX);
        set {
            $this->setData(self::ORDER_AVERAGE_INDEX, $value);
        }
    }

    // orderCount
    public const string ORDER_COUNT_PROP = 'orderCount';
    private const int ORDER_COUNT_INDEX = 5;

    public ?int $orderCount {
        get => $this->getData(self::ORDER_COUNT_INDEX);
        set {
            $this->setData(self::ORDER_COUNT_INDEX, $value);
        }
    }

    // orderReferences
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string ORDER_REFERENCES_PROP = 'orderReferences';
    private const int ORDER_REFERENCES_INDEX = 6;

    /** @var \ArrayObject<int|string,mixed> */
    public ArrayObject $orderReferences {
        get => $this->getData(self::ORDER_REFERENCES_INDEX);
        set {
            $this->setData(self::ORDER_REFERENCES_INDEX, $value);
        }
    }
}
