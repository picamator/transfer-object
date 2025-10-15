<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use DateTime;
use DateTimeImmutable;
use Picamator\Tests\Integration\TransferObject\Transfer\Enum\ImBackedEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayObjectTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\DateTimeTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\EnumTransformerAttribute;

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
    #[ArrayInitiatorAttribute]
    public const string I_AM_ARRAY = 'iAmArray';
    private const int I_AM_ARRAY_INDEX = 0;

    /** @var array<int|string,mixed> */
    public array $iAmArray {
        get => $this->getData(self::I_AM_ARRAY_INDEX);
        set => $this->setData(self::I_AM_ARRAY_INDEX, $value);
    }

    // iAmArrayObject
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string I_AM_ARRAY_OBJECT = 'iAmArrayObject';
    private const int I_AM_ARRAY_OBJECT_INDEX = 1;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $iAmArrayObject {
        get => $this->getData(self::I_AM_ARRAY_OBJECT_INDEX);
        set => $this->setData(self::I_AM_ARRAY_OBJECT_INDEX, $value);
    }

    // iAmBool
    public const string I_AM_BOOL = 'iAmBool';
    private const int I_AM_BOOL_INDEX = 2;

    public ?bool $iAmBool {
        get => $this->getData(self::I_AM_BOOL_INDEX);
        set => $this->setData(self::I_AM_BOOL_INDEX, $value);
    }

    // iAmDateTime
    #[DateTimeTransformerAttribute(DateTime::class)]
    public const string I_AM_DATE_TIME = 'iAmDateTime';
    private const int I_AM_DATE_TIME_INDEX = 3;

    public ?DateTime $iAmDateTime {
        get => $this->getData(self::I_AM_DATE_TIME_INDEX);
        set => $this->setData(self::I_AM_DATE_TIME_INDEX, $value);
    }

    // iAmDateTimeImmutable
    #[DateTimeTransformerAttribute(DateTimeImmutable::class)]
    public const string I_AM_DATE_TIME_IMMUTABLE = 'iAmDateTimeImmutable';
    private const int I_AM_DATE_TIME_IMMUTABLE_INDEX = 4;

    public ?DateTimeImmutable $iAmDateTimeImmutable {
        get => $this->getData(self::I_AM_DATE_TIME_IMMUTABLE_INDEX);
        set => $this->setData(self::I_AM_DATE_TIME_IMMUTABLE_INDEX, $value);
    }

    // iAmEnum
    #[EnumTransformerAttribute(ImBackedEnum::class)]
    public const string I_AM_ENUM = 'iAmEnum';
    private const int I_AM_ENUM_INDEX = 5;

    public ?ImBackedEnum $iAmEnum {
        get => $this->getData(self::I_AM_ENUM_INDEX);
        set => $this->setData(self::I_AM_ENUM_INDEX, $value);
    }

    // iAmFalse
    public const string I_AM_FALSE = 'iAmFalse';
    private const int I_AM_FALSE_INDEX = 6;

    public ?false $iAmFalse {
        get => $this->getData(self::I_AM_FALSE_INDEX);
        set => $this->setData(self::I_AM_FALSE_INDEX, $value);
    }

    // iAmFloat
    public const string I_AM_FLOAT = 'iAmFloat';
    private const int I_AM_FLOAT_INDEX = 7;

    public ?float $iAmFloat {
        get => $this->getData(self::I_AM_FLOAT_INDEX);
        set => $this->setData(self::I_AM_FLOAT_INDEX, $value);
    }

    // iAmInt
    public const string I_AM_INT = 'iAmInt';
    private const int I_AM_INT_INDEX = 8;

    public ?int $iAmInt {
        get => $this->getData(self::I_AM_INT_INDEX);
        set => $this->setData(self::I_AM_INT_INDEX, $value);
    }

    // iAmString
    public const string I_AM_STRING = 'iAmString';
    private const int I_AM_STRING_INDEX = 9;

    public ?string $iAmString {
        get => $this->getData(self::I_AM_STRING_INDEX);
        set => $this->setData(self::I_AM_STRING_INDEX, $value);
    }

    // iAmTrue
    public const string I_AM_TRUE = 'iAmTrue';
    private const int I_AM_TRUE_INDEX = 10;

    public ?true $iAmTrue {
        get => $this->getData(self::I_AM_TRUE_INDEX);
        set => $this->setData(self::I_AM_TRUE_INDEX, $value);
    }
}
