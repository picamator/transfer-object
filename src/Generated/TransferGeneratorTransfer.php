<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class TransferGeneratorTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CLASS_NAME_INDEX => self::CLASS_NAME,
        self::FILE_NAME_INDEX => self::FILE_NAME,
        self::VALIDATOR_INDEX => self::VALIDATOR,
    ];

    // className
    public const string CLASS_NAME = 'className';
    protected const int CLASS_NAME_INDEX = 0;

    public ?string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set => $this->setData(self::CLASS_NAME_INDEX, $value);
    }

    // fileName
    public const string FILE_NAME = 'fileName';
    protected const int FILE_NAME_INDEX = 1;

    public ?string $fileName {
        get => $this->getData(self::FILE_NAME_INDEX);
        set => $this->setData(self::FILE_NAME_INDEX, $value);
    }

    // validator
    #[PropertyTypeAttribute(ValidatorTransfer::class)]
    public const string VALIDATOR = 'validator';
    protected const int VALIDATOR_INDEX = 2;

    public ValidatorTransfer $validator {
        get => $this->getData(self::VALIDATOR_INDEX);
        set => $this->setData(self::VALIDATOR_INDEX, $value);
    }
}
