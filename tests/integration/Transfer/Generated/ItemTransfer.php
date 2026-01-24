<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use DateTime;
use DateTimeImmutable;
use Picamator\Tests\Integration\TransferObject\Helper\Attribute\PropertyAttribute;
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
    protected const int META_DATA_SIZE = 14;

    protected const array META_DATA = [
        self::I_AM_ARRAY_PROP => self::I_AM_ARRAY_INDEX,
        self::I_AM_ARRAY_OBJECT_PROP => self::I_AM_ARRAY_OBJECT_INDEX,
        self::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => self::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_INDEX,
        self::I_AM_ARRAY_WITH_DOC_BLOCK_PROP => self::I_AM_ARRAY_WITH_DOC_BLOCK_INDEX,
        self::I_AM_BOOL_PROP => self::I_AM_BOOL_INDEX,
        self::I_AM_DATE_TIME_PROP => self::I_AM_DATE_TIME_INDEX,
        self::I_AM_DATE_TIME_IMMUTABLE_PROP => self::I_AM_DATE_TIME_IMMUTABLE_INDEX,
        self::I_AM_ENUM_PROP => self::I_AM_ENUM_INDEX,
        self::I_AM_FALSE_PROP => self::I_AM_FALSE_INDEX,
        self::I_AM_FLOAT_PROP => self::I_AM_FLOAT_INDEX,
        self::I_AM_INT_PROP => self::I_AM_INT_INDEX,
        self::I_AM_STRING_PROP => self::I_AM_STRING_INDEX,
        self::I_AM_TRUE_PROP => self::I_AM_TRUE_INDEX,
        self::I_AM_WITH_ATTRIBUTE_PROP => self::I_AM_WITH_ATTRIBUTE_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::I_AM_ARRAY_PROP => 'I_AM_ARRAY_PROP',
        self::I_AM_ARRAY_OBJECT_PROP => 'I_AM_ARRAY_OBJECT_PROP',
        self::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => 'I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP',
        self::I_AM_ARRAY_WITH_DOC_BLOCK_PROP => 'I_AM_ARRAY_WITH_DOC_BLOCK_PROP',
        self::I_AM_WITH_ATTRIBUTE_PROP => 'I_AM_WITH_ATTRIBUTE_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::I_AM_ARRAY_OBJECT_PROP => 'I_AM_ARRAY_OBJECT_PROP',
        self::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP => 'I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP',
        self::I_AM_DATE_TIME_PROP => 'I_AM_DATE_TIME_PROP',
        self::I_AM_DATE_TIME_IMMUTABLE_PROP => 'I_AM_DATE_TIME_IMMUTABLE_PROP',
        self::I_AM_ENUM_PROP => 'I_AM_ENUM_PROP',
    ];

    // iAmArray
    #[ArrayInitiatorAttribute]
    public const string I_AM_ARRAY_PROP = 'iAmArray';
    private const int I_AM_ARRAY_INDEX = 0;

    /** @var array<int|string,mixed> */
    public array $iAmArray {
        get => $this->getData(self::I_AM_ARRAY_INDEX);
        set {
            $this->setData(self::I_AM_ARRAY_INDEX, $value);
        }
    }

    // iAmArrayObject
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string I_AM_ARRAY_OBJECT_PROP = 'iAmArrayObject';
    private const int I_AM_ARRAY_OBJECT_INDEX = 1;

    /** @var \ArrayObject<int|string,mixed> */
    public ArrayObject $iAmArrayObject {
        get => $this->getData(self::I_AM_ARRAY_OBJECT_INDEX);
        set {
            $this->setData(self::I_AM_ARRAY_OBJECT_INDEX, $value);
        }
    }

    // iAmArrayObjectWithDockBlock
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_PROP = 'iAmArrayObjectWithDockBlock';
    private const int I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_INDEX = 2;

    /** @var \ArrayObject<int,string> */
    public ArrayObject $iAmArrayObjectWithDockBlock {
        get => $this->getData(self::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_INDEX);
        set {
            $this->setData(self::I_AM_ARRAY_OBJECT_WITH_DOCK_BLOCK_INDEX, $value);
        }
    }

    // iAmArrayWithDocBlock
    #[ArrayInitiatorAttribute]
    public const string I_AM_ARRAY_WITH_DOC_BLOCK_PROP = 'iAmArrayWithDocBlock';
    private const int I_AM_ARRAY_WITH_DOC_BLOCK_INDEX = 3;

    /** @var array<int,string> */
    public array $iAmArrayWithDocBlock {
        get => $this->getData(self::I_AM_ARRAY_WITH_DOC_BLOCK_INDEX);
        set {
            $this->setData(self::I_AM_ARRAY_WITH_DOC_BLOCK_INDEX, $value);
        }
    }

    // iAmBool
    public const string I_AM_BOOL_PROP = 'iAmBool';
    private const int I_AM_BOOL_INDEX = 4;

    public ?bool $iAmBool {
        get => $this->getData(self::I_AM_BOOL_INDEX);
        set {
            $this->setData(self::I_AM_BOOL_INDEX, $value);
        }
    }

    // iAmDateTime
    #[DateTimeTransformerAttribute(DateTime::class)]
    public const string I_AM_DATE_TIME_PROP = 'iAmDateTime';
    private const int I_AM_DATE_TIME_INDEX = 5;

    public ?DateTime $iAmDateTime {
        get => $this->getData(self::I_AM_DATE_TIME_INDEX);
        set {
            $this->setData(self::I_AM_DATE_TIME_INDEX, $value);
        }
    }

    // iAmDateTimeImmutable
    #[DateTimeTransformerAttribute(DateTimeImmutable::class)]
    public const string I_AM_DATE_TIME_IMMUTABLE_PROP = 'iAmDateTimeImmutable';
    private const int I_AM_DATE_TIME_IMMUTABLE_INDEX = 6;

    public ?DateTimeImmutable $iAmDateTimeImmutable {
        get => $this->getData(self::I_AM_DATE_TIME_IMMUTABLE_INDEX);
        set {
            $this->setData(self::I_AM_DATE_TIME_IMMUTABLE_INDEX, $value);
        }
    }

    // iAmEnum
    #[EnumTransformerAttribute(ImBackedEnum::class)]
    public const string I_AM_ENUM_PROP = 'iAmEnum';
    private const int I_AM_ENUM_INDEX = 7;

    public ?ImBackedEnum $iAmEnum {
        get => $this->getData(self::I_AM_ENUM_INDEX);
        set {
            $this->setData(self::I_AM_ENUM_INDEX, $value);
        }
    }

    // iAmFalse
    public const string I_AM_FALSE_PROP = 'iAmFalse';
    private const int I_AM_FALSE_INDEX = 8;

    public ?false $iAmFalse {
        get => $this->getData(self::I_AM_FALSE_INDEX);
        set {
            $this->setData(self::I_AM_FALSE_INDEX, $value);
        }
    }

    // iAmFloat
    public const string I_AM_FLOAT_PROP = 'iAmFloat';
    private const int I_AM_FLOAT_INDEX = 9;

    public ?float $iAmFloat {
        get => $this->getData(self::I_AM_FLOAT_INDEX);
        set {
            $this->setData(self::I_AM_FLOAT_INDEX, $value);
        }
    }

    // iAmInt
    public const string I_AM_INT_PROP = 'iAmInt';
    private const int I_AM_INT_INDEX = 10;

    public ?int $iAmInt {
        get => $this->getData(self::I_AM_INT_INDEX);
        set {
            $this->setData(self::I_AM_INT_INDEX, $value);
        }
    }

    // iAmString
    public const string I_AM_STRING_PROP = 'iAmString';
    private const int I_AM_STRING_INDEX = 11;

    public ?string $iAmString {
        get => $this->getData(self::I_AM_STRING_INDEX);
        set {
            $this->setData(self::I_AM_STRING_INDEX, $value);
        }
    }

    // iAmTrue
    public const string I_AM_TRUE_PROP = 'iAmTrue';
    private const int I_AM_TRUE_INDEX = 12;

    public ?true $iAmTrue {
        get => $this->getData(self::I_AM_TRUE_INDEX);
        set {
            $this->setData(self::I_AM_TRUE_INDEX, $value);
        }
    }

    // iAmWithAttribute
    #[ArrayInitiatorAttribute]
    public const string I_AM_WITH_ATTRIBUTE_PROP = 'iAmWithAttribute';
    private const int I_AM_WITH_ATTRIBUTE_INDEX = 13;

    /** @var array<string> */
    #[PropertyAttribute(property: 'iAmWithAttribute')]
    public array $iAmWithAttribute {
        get => $this->getData(self::I_AM_WITH_ATTRIBUTE_INDEX);
        set {
            $this->setData(self::I_AM_WITH_ATTRIBUTE_INDEX, $value);
        }
    }
}
