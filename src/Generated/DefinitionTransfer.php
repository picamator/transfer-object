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
final class DefinitionTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::FILE_NAME => self::FILE_NAME_DATA_NAME,
        self::VALIDATOR => self::VALIDATOR_DATA_NAME,
    ];

    // content
    #[PropertyTypeAttribute(DefinitionContentTransfer::class)]
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 0;

    public DefinitionContentTransfer $content {
        get => $this->getData(self::CONTENT_DATA_INDEX);
        set => $this->setData(self::CONTENT_DATA_INDEX, $value);
    }

    // fileName
    public const string FILE_NAME = 'fileName';
    protected const string FILE_NAME_DATA_NAME = 'FILE_NAME';
    protected const int FILE_NAME_DATA_INDEX = 1;

    public string $fileName {
        get => $this->getData(self::FILE_NAME_DATA_INDEX);
        set => $this->setData(self::FILE_NAME_DATA_INDEX, $value);
    }

    // validator
    #[PropertyTypeAttribute(ValidatorTransfer::class)]
    public const string VALIDATOR = 'validator';
    protected const string VALIDATOR_DATA_NAME = 'VALIDATOR';
    protected const int VALIDATOR_DATA_INDEX = 2;

    public ValidatorTransfer $validator {
        get => $this->getData(self::VALIDATOR_DATA_INDEX);
        set => $this->setData(self::VALIDATOR_DATA_INDEX, $value);
    }
}
