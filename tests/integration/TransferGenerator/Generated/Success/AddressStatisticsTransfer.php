<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class AddressStatisticsTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 7;

    protected const array META_DATA = [
        self::ADDRESS_BOOK_UUID => self::ADDRESS_BOOK_UUID_DATA_NAME,
        self::ADDRESS_UUID => self::ADDRESS_UUID_DATA_NAME,
        self::IS_ACTIVE => self::IS_ACTIVE_DATA_NAME,
        self::IS_BLOCKED => self::IS_BLOCKED_DATA_NAME,
        self::ORDER_AVERAGE => self::ORDER_AVERAGE_DATA_NAME,
        self::ORDER_COUNT => self::ORDER_COUNT_DATA_NAME,
        self::ORDER_REFERENCES => self::ORDER_REFERENCES_DATA_NAME,
    ];

    // addressBookUuid
    public const string ADDRESS_BOOK_UUID = 'addressBookUuid';
    protected const string ADDRESS_BOOK_UUID_DATA_NAME = 'ADDRESS_BOOK_UUID';
    protected const int ADDRESS_BOOK_UUID_DATA_INDEX = 0;

    public ?string $addressBookUuid {
        get => $this->getData(self::ADDRESS_BOOK_UUID_DATA_INDEX);
        set => $this->setData(self::ADDRESS_BOOK_UUID_DATA_INDEX, $value);
    }

    // addressUuid
    public const string ADDRESS_UUID = 'addressUuid';
    protected const string ADDRESS_UUID_DATA_NAME = 'ADDRESS_UUID';
    protected const int ADDRESS_UUID_DATA_INDEX = 1;

    public ?string $addressUuid {
        get => $this->getData(self::ADDRESS_UUID_DATA_INDEX);
        set => $this->setData(self::ADDRESS_UUID_DATA_INDEX, $value);
    }

    // isActive
    public const string IS_ACTIVE = 'isActive';
    protected const string IS_ACTIVE_DATA_NAME = 'IS_ACTIVE';
    protected const int IS_ACTIVE_DATA_INDEX = 2;

    public ?true $isActive {
        get => $this->getData(self::IS_ACTIVE_DATA_INDEX);
        set => $this->setData(self::IS_ACTIVE_DATA_INDEX, $value);
    }

    // isBlocked
    public const string IS_BLOCKED = 'isBlocked';
    protected const string IS_BLOCKED_DATA_NAME = 'IS_BLOCKED';
    protected const int IS_BLOCKED_DATA_INDEX = 3;

    public ?false $isBlocked {
        get => $this->getData(self::IS_BLOCKED_DATA_INDEX);
        set => $this->setData(self::IS_BLOCKED_DATA_INDEX, $value);
    }

    // orderAverage
    public const string ORDER_AVERAGE = 'orderAverage';
    protected const string ORDER_AVERAGE_DATA_NAME = 'ORDER_AVERAGE';
    protected const int ORDER_AVERAGE_DATA_INDEX = 4;

    public ?float $orderAverage {
        get => $this->getData(self::ORDER_AVERAGE_DATA_INDEX);
        set => $this->setData(self::ORDER_AVERAGE_DATA_INDEX, $value);
    }

    // orderCount
    public const string ORDER_COUNT = 'orderCount';
    protected const string ORDER_COUNT_DATA_NAME = 'ORDER_COUNT';
    protected const int ORDER_COUNT_DATA_INDEX = 5;

    public ?int $orderCount {
        get => $this->getData(self::ORDER_COUNT_DATA_INDEX);
        set => $this->setData(self::ORDER_COUNT_DATA_INDEX, $value);
    }

    // orderReferences
    #[ArrayObjectPropertyTypeAttribute]
    public const string ORDER_REFERENCES = 'orderReferences';
    protected const string ORDER_REFERENCES_DATA_NAME = 'ORDER_REFERENCES';
    protected const int ORDER_REFERENCES_DATA_INDEX = 6;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $orderReferences {
        get => $this->getRequiredData(self::ORDER_REFERENCES_DATA_INDEX);
        set => $this->setData(self::ORDER_REFERENCES_DATA_INDEX, $value);
    }
}
