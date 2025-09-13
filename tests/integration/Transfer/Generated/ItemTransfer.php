<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use DateTime;
use DateTimeImmutable;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBackedEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\DateTimePropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/item.transfer.yml Definition file path.
 */
final class ItemTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 11;

    protected const array META_DATA = [
        self::I_AM_ARRAY_INDEX => self::I_AM_ARRAY,
        self::I_AM_ARRAY_OBJECT_INDEX => self::I_AM_ARRAY_OBJECT,
        self::I_AM_BOOL_INDEX => self::I_AM_BOOL,
        self::I_AM_DATE_TIME_INDEX => self::I_AM_DATE_TIME,
        self::I_AM_DATE_TIME_IMMUTABLE_INDEX => self::I_AM_DATE_TIME_IMMUTABLE,
        self::I_AM_ENUM_INDEX => self::I_AM_ENUM,
        self::I_AM_FALSE_INDEX => self::I_AM_FALSE,
        self::I_AM_FLOAT_INDEX => self::I_AM_FLOAT,
        self::I_AM_INT_INDEX => self::I_AM_INT,
        self::I_AM_STRING_INDEX => self::I_AM_STRING,
        self::I_AM_TRUE_INDEX => self::I_AM_TRUE,
    ];

    // iAmArray
    #[ArrayPropertyTypeAttribute]
    public const string I_AM_ARRAY = 'iAmArray';
    protected const int I_AM_ARRAY_INDEX = 0;

    /** @var array<int|string,mixed> */
    public array $iAmArray {
        get => $this->getData(self::I_AM_ARRAY_INDEX);
        set => $this->setData(self::I_AM_ARRAY_INDEX, $value);
    }

    // iAmArrayObject
    #[ArrayObjectPropertyTypeAttribute]
    public const string I_AM_ARRAY_OBJECT = 'iAmArrayObject';
    protected const int I_AM_ARRAY_OBJECT_INDEX = 1;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $iAmArrayObject {
        get => $this->getData(self::I_AM_ARRAY_OBJECT_INDEX);
        set => $this->setData(self::I_AM_ARRAY_OBJECT_INDEX, $value);
    }

    // iAmBool
    public const string I_AM_BOOL = 'iAmBool';
    protected const int I_AM_BOOL_INDEX = 2;

    public ?bool $iAmBool {
        get => $this->getData(self::I_AM_BOOL_INDEX);
        set => $this->setData(self::I_AM_BOOL_INDEX, $value);
    }

    // iAmDateTime
    #[DateTimePropertyTypeAttribute(DateTime::class)]
    public const string I_AM_DATE_TIME = 'iAmDateTime';
    protected const int I_AM_DATE_TIME_INDEX = 3;

    public ?DateTime $iAmDateTime {
        get => $this->getData(self::I_AM_DATE_TIME_INDEX);
        set => $this->setData(self::I_AM_DATE_TIME_INDEX, $value);
    }

    // iAmDateTimeImmutable
    #[DateTimePropertyTypeAttribute(DateTimeImmutable::class)]
    public const string I_AM_DATE_TIME_IMMUTABLE = 'iAmDateTimeImmutable';
    protected const int I_AM_DATE_TIME_IMMUTABLE_INDEX = 4;

    public ?DateTimeImmutable $iAmDateTimeImmutable {
        get => $this->getData(self::I_AM_DATE_TIME_IMMUTABLE_INDEX);
        set => $this->setData(self::I_AM_DATE_TIME_IMMUTABLE_INDEX, $value);
    }

    // iAmEnum
    #[EnumPropertyTypeAttribute(ImBackedEnum::class)]
    public const string I_AM_ENUM = 'iAmEnum';
    protected const int I_AM_ENUM_INDEX = 5;

    public ?ImBackedEnum $iAmEnum {
        get => $this->getData(self::I_AM_ENUM_INDEX);
        set => $this->setData(self::I_AM_ENUM_INDEX, $value);
    }

    // iAmFalse
    public const string I_AM_FALSE = 'iAmFalse';
    protected const int I_AM_FALSE_INDEX = 6;

    public ?false $iAmFalse {
        get => $this->getData(self::I_AM_FALSE_INDEX);
        set => $this->setData(self::I_AM_FALSE_INDEX, $value);
    }

    // iAmFloat
    public const string I_AM_FLOAT = 'iAmFloat';
    protected const int I_AM_FLOAT_INDEX = 7;

    public ?float $iAmFloat {
        get => $this->getData(self::I_AM_FLOAT_INDEX);
        set => $this->setData(self::I_AM_FLOAT_INDEX, $value);
    }

    // iAmInt
    public const string I_AM_INT = 'iAmInt';
    protected const int I_AM_INT_INDEX = 8;

    public ?int $iAmInt {
        get => $this->getData(self::I_AM_INT_INDEX);
        set => $this->setData(self::I_AM_INT_INDEX, $value);
    }

    // iAmString
    public const string I_AM_STRING = 'iAmString';
    protected const int I_AM_STRING_INDEX = 9;

    public ?string $iAmString {
        get => $this->getData(self::I_AM_STRING_INDEX);
        set => $this->setData(self::I_AM_STRING_INDEX, $value);
    }

    // iAmTrue
    public const string I_AM_TRUE = 'iAmTrue';
    protected const int I_AM_TRUE_INDEX = 10;

    public ?true $iAmTrue {
        get => $this->getData(self::I_AM_TRUE_INDEX);
        set => $this->setData(self::I_AM_TRUE_INDEX, $value);
    }
}
