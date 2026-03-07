<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

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
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class TransferHashTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::ACTUAL_HASHES_PROP => self::ACTUAL_HASHES_INDEX,
        self::CONFIG_UUID_PROP => self::CONFIG_UUID_INDEX,
        self::HASHES_PROP => self::HASHES_INDEX,
        self::TO_COPY_CLASS_NAMES_PROP => self::TO_COPY_CLASS_NAMES_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::ACTUAL_HASHES_PROP => 'ACTUAL_HASHES_PROP',
        self::HASHES_PROP => 'HASHES_PROP',
        self::TO_COPY_CLASS_NAMES_PROP => 'TO_COPY_CLASS_NAMES_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::ACTUAL_HASHES_PROP => 'ACTUAL_HASHES_PROP',
        self::HASHES_PROP => 'HASHES_PROP',
        self::TO_COPY_CLASS_NAMES_PROP => 'TO_COPY_CLASS_NAMES_PROP',
    ];

    // actualHashes
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string ACTUAL_HASHES_PROP = 'actualHashes';
    private const int ACTUAL_HASHES_INDEX = 0;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $actualHashes {
        get => $this->getData(self::ACTUAL_HASHES_INDEX);
        set {
            $this->setData(self::ACTUAL_HASHES_INDEX, $value);
        }
    }

    // configUuid
    public const string CONFIG_UUID_PROP = 'configUuid';
    private const int CONFIG_UUID_INDEX = 1;

    public protected(set) string $configUuid {
        get => $this->getData(self::CONFIG_UUID_INDEX);
        set {
            $this->setData(self::CONFIG_UUID_INDEX, $value);
        }
    }

    // hashes
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string HASHES_PROP = 'hashes';
    private const int HASHES_INDEX = 2;

    /** @var \ArrayObject<string,string> */
    public protected(set) ArrayObject $hashes {
        get => $this->getData(self::HASHES_INDEX);
        set {
            $this->setData(self::HASHES_INDEX, $value);
        }
    }

    // toCopyClassNames
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string TO_COPY_CLASS_NAMES_PROP = 'toCopyClassNames';
    private const int TO_COPY_CLASS_NAMES_INDEX = 3;

    /** @var \ArrayObject<int,string> */
    public ArrayObject $toCopyClassNames {
        get => $this->getData(self::TO_COPY_CLASS_NAMES_INDEX);
        set {
            $this->setData(self::TO_COPY_CLASS_NAMES_INDEX, $value);
        }
    }
}
