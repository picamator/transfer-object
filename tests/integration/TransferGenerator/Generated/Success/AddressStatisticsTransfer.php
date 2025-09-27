<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;

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
        self::ADDRESS_BOOK_UUID_INDEX => self::ADDRESS_BOOK_UUID,
        self::ADDRESS_UUID_INDEX => self::ADDRESS_UUID,
        self::IS_ACTIVE_INDEX => self::IS_ACTIVE,
        self::IS_BLOCKED_INDEX => self::IS_BLOCKED,
        self::ORDER_AVERAGE_INDEX => self::ORDER_AVERAGE,
        self::ORDER_COUNT_INDEX => self::ORDER_COUNT,
        self::ORDER_REFERENCES_INDEX => self::ORDER_REFERENCES,
    ];

    // addressBookUuid
    public const string ADDRESS_BOOK_UUID = 'addressBookUuid';
    private const int ADDRESS_BOOK_UUID_INDEX = 0;

    public ?string $addressBookUuid {
        get => $this->getData(self::ADDRESS_BOOK_UUID_INDEX);
        set => $this->setData(self::ADDRESS_BOOK_UUID_INDEX, $value);
    }

    // addressUuid
    public const string ADDRESS_UUID = 'addressUuid';
    private const int ADDRESS_UUID_INDEX = 1;

    public ?string $addressUuid {
        get => $this->getData(self::ADDRESS_UUID_INDEX);
        set => $this->setData(self::ADDRESS_UUID_INDEX, $value);
    }

    // isActive
    public const string IS_ACTIVE = 'isActive';
    private const int IS_ACTIVE_INDEX = 2;

    public ?true $isActive {
        get => $this->getData(self::IS_ACTIVE_INDEX);
        set => $this->setData(self::IS_ACTIVE_INDEX, $value);
    }

    // isBlocked
    public const string IS_BLOCKED = 'isBlocked';
    private const int IS_BLOCKED_INDEX = 3;

    public ?false $isBlocked {
        get => $this->getData(self::IS_BLOCKED_INDEX);
        set => $this->setData(self::IS_BLOCKED_INDEX, $value);
    }

    // orderAverage
    public const string ORDER_AVERAGE = 'orderAverage';
    private const int ORDER_AVERAGE_INDEX = 4;

    public ?float $orderAverage {
        get => $this->getData(self::ORDER_AVERAGE_INDEX);
        set => $this->setData(self::ORDER_AVERAGE_INDEX, $value);
    }

    // orderCount
    public const string ORDER_COUNT = 'orderCount';
    private const int ORDER_COUNT_INDEX = 5;

    public ?int $orderCount {
        get => $this->getData(self::ORDER_COUNT_INDEX);
        set => $this->setData(self::ORDER_COUNT_INDEX, $value);
    }

    // orderReferences
    #[ArrayObjectPropertyTypeAttribute]
    public const string ORDER_REFERENCES = 'orderReferences';
    private const int ORDER_REFERENCES_INDEX = 6;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $orderReferences {
        get => $this->getData(self::ORDER_REFERENCES_INDEX);
        set => $this->setData(self::ORDER_REFERENCES_INDEX, $value);
    }
}
