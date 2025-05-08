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
        self::I_AM_ARRAY => self::I_AM_ARRAY_DATA_NAME,
        self::I_AM_ARRAY_OBJECT => self::I_AM_ARRAY_OBJECT_DATA_NAME,
        self::I_AM_BOOL => self::I_AM_BOOL_DATA_NAME,
        self::I_AM_DATE_TIME => self::I_AM_DATE_TIME_DATA_NAME,
        self::I_AM_DATE_TIME_IMMUTABLE => self::I_AM_DATE_TIME_IMMUTABLE_DATA_NAME,
        self::I_AM_ENUM => self::I_AM_ENUM_DATA_NAME,
        self::I_AM_FALSE => self::I_AM_FALSE_DATA_NAME,
        self::I_AM_FLOAT => self::I_AM_FLOAT_DATA_NAME,
        self::I_AM_INT => self::I_AM_INT_DATA_NAME,
        self::I_AM_STRING => self::I_AM_STRING_DATA_NAME,
        self::I_AM_TRUE => self::I_AM_TRUE_DATA_NAME,
    ];

    // iAmArray
    #[ArrayPropertyTypeAttribute]
    public const string I_AM_ARRAY = 'iAmArray';
    protected const string I_AM_ARRAY_DATA_NAME = 'I_AM_ARRAY';
    protected const int I_AM_ARRAY_DATA_INDEX = 0;

    /** @var array<int|string,mixed> */
    public array $iAmArray {
        get => $this->getData(self::I_AM_ARRAY_DATA_INDEX);
        set => $this->setData(self::I_AM_ARRAY_DATA_INDEX, $value);
    }

    // iAmArrayObject
    #[ArrayObjectPropertyTypeAttribute]
    public const string I_AM_ARRAY_OBJECT = 'iAmArrayObject';
    protected const string I_AM_ARRAY_OBJECT_DATA_NAME = 'I_AM_ARRAY_OBJECT';
    protected const int I_AM_ARRAY_OBJECT_DATA_INDEX = 1;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $iAmArrayObject {
        get => $this->getData(self::I_AM_ARRAY_OBJECT_DATA_INDEX);
        set => $this->setData(self::I_AM_ARRAY_OBJECT_DATA_INDEX, $value);
    }

    // iAmBool
    public const string I_AM_BOOL = 'iAmBool';
    protected const string I_AM_BOOL_DATA_NAME = 'I_AM_BOOL';
    protected const int I_AM_BOOL_DATA_INDEX = 2;

    public ?bool $iAmBool {
        get => $this->getData(self::I_AM_BOOL_DATA_INDEX);
        set => $this->setData(self::I_AM_BOOL_DATA_INDEX, $value);
    }

    // iAmDateTime
    #[DateTimePropertyTypeAttribute(DateTime::class)]
    public const string I_AM_DATE_TIME = 'iAmDateTime';
    protected const string I_AM_DATE_TIME_DATA_NAME = 'I_AM_DATE_TIME';
    protected const int I_AM_DATE_TIME_DATA_INDEX = 3;

    public ?DateTime $iAmDateTime {
        get => $this->getData(self::I_AM_DATE_TIME_DATA_INDEX);
        set => $this->setData(self::I_AM_DATE_TIME_DATA_INDEX, $value);
    }

    // iAmDateTimeImmutable
    #[DateTimePropertyTypeAttribute(DateTimeImmutable::class)]
    public const string I_AM_DATE_TIME_IMMUTABLE = 'iAmDateTimeImmutable';
    protected const string I_AM_DATE_TIME_IMMUTABLE_DATA_NAME = 'I_AM_DATE_TIME_IMMUTABLE';
    protected const int I_AM_DATE_TIME_IMMUTABLE_DATA_INDEX = 4;

    public ?DateTimeImmutable $iAmDateTimeImmutable {
        get => $this->getData(self::I_AM_DATE_TIME_IMMUTABLE_DATA_INDEX);
        set => $this->setData(self::I_AM_DATE_TIME_IMMUTABLE_DATA_INDEX, $value);
    }

    // iAmEnum
    #[EnumPropertyTypeAttribute(ImBackedEnum::class)]
    public const string I_AM_ENUM = 'iAmEnum';
    protected const string I_AM_ENUM_DATA_NAME = 'I_AM_ENUM';
    protected const int I_AM_ENUM_DATA_INDEX = 5;

    public ?ImBackedEnum $iAmEnum {
        get => $this->getData(self::I_AM_ENUM_DATA_INDEX);
        set => $this->setData(self::I_AM_ENUM_DATA_INDEX, $value);
    }

    // iAmFalse
    public const string I_AM_FALSE = 'iAmFalse';
    protected const string I_AM_FALSE_DATA_NAME = 'I_AM_FALSE';
    protected const int I_AM_FALSE_DATA_INDEX = 6;

    public ?false $iAmFalse {
        get => $this->getData(self::I_AM_FALSE_DATA_INDEX);
        set => $this->setData(self::I_AM_FALSE_DATA_INDEX, $value);
    }

    // iAmFloat
    public const string I_AM_FLOAT = 'iAmFloat';
    protected const string I_AM_FLOAT_DATA_NAME = 'I_AM_FLOAT';
    protected const int I_AM_FLOAT_DATA_INDEX = 7;

    public ?float $iAmFloat {
        get => $this->getData(self::I_AM_FLOAT_DATA_INDEX);
        set => $this->setData(self::I_AM_FLOAT_DATA_INDEX, $value);
    }

    // iAmInt
    public const string I_AM_INT = 'iAmInt';
    protected const string I_AM_INT_DATA_NAME = 'I_AM_INT';
    protected const int I_AM_INT_DATA_INDEX = 8;

    public ?int $iAmInt {
        get => $this->getData(self::I_AM_INT_DATA_INDEX);
        set => $this->setData(self::I_AM_INT_DATA_INDEX, $value);
    }

    // iAmString
    public const string I_AM_STRING = 'iAmString';
    protected const string I_AM_STRING_DATA_NAME = 'I_AM_STRING';
    protected const int I_AM_STRING_DATA_INDEX = 9;

    public ?string $iAmString {
        get => $this->getData(self::I_AM_STRING_DATA_INDEX);
        set => $this->setData(self::I_AM_STRING_DATA_INDEX, $value);
    }

    // iAmTrue
    public const string I_AM_TRUE = 'iAmTrue';
    protected const string I_AM_TRUE_DATA_NAME = 'I_AM_TRUE';
    protected const int I_AM_TRUE_DATA_INDEX = 10;

    public ?true $iAmTrue {
        get => $this->getData(self::I_AM_TRUE_DATA_INDEX);
        set => $this->setData(self::I_AM_TRUE_DATA_INDEX, $value);
    }
}
