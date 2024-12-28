<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class ConfigValidatorTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ERROR_MESSAGES => self::ERROR_MESSAGES_DATA_NAME,
        self::IS_VALID => self::IS_VALID_DATA_NAME,
    ];

    // errorMessages
    #[CollectionPropertyTypeAttribute(ValidatorMessageTransfer::class)]
    public const string ERROR_MESSAGES = 'errorMessages';
    protected const string ERROR_MESSAGES_DATA_NAME = 'ERROR_MESSAGES';
    protected const int ERROR_MESSAGES_DATA_INDEX = 0;

    /** @var \ArrayObject<int,ValidatorMessageTransfer> */
    public ArrayObject $errorMessages {
        get => $this->_data[self::ERROR_MESSAGES_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::ERROR_MESSAGES_DATA_INDEX] = $value;
    }

    // isValid
    public const string IS_VALID = 'isValid';
    protected const string IS_VALID_DATA_NAME = 'IS_VALID';
    protected const int IS_VALID_DATA_INDEX = 1;

    public ?bool $isValid {
        get => $this->_data[self::IS_VALID_DATA_INDEX];
        set => $this->_data[self::IS_VALID_DATA_INDEX] = $value;
    }
}
