<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class TransferGeneratorTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::FILE_NAME => self::FILE_NAME_DATA_NAME,
        self::VALIDATOR => self::VALIDATOR_DATA_NAME,
    ];

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 0;

    public ?string $className {
        get => $this->getData(self::CLASS_NAME_DATA_INDEX);
        set => $this->setData(self::CLASS_NAME_DATA_INDEX, $value);
    }

    // fileName
    public const string FILE_NAME = 'fileName';
    protected const string FILE_NAME_DATA_NAME = 'FILE_NAME';
    protected const int FILE_NAME_DATA_INDEX = 1;

    public ?string $fileName {
        get => $this->getData(self::FILE_NAME_DATA_INDEX);
        set => $this->setData(self::FILE_NAME_DATA_INDEX, $value);
    }

    // validator
    #[PropertyTypeAttribute(DefinitionValidatorTransfer::class)]
    public const string VALIDATOR = 'validator';
    protected const string VALIDATOR_DATA_NAME = 'VALIDATOR';
    protected const int VALIDATOR_DATA_INDEX = 2;

    public DefinitionValidatorTransfer $validator {
        get => $this->getRequiredData(self::VALIDATOR_DATA_INDEX);
        set => $this->setData(self::VALIDATOR_DATA_INDEX, $value);
    }
}
