<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class ValidatorMessageTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ERROR_MESSAGE => self::ERROR_MESSAGE_DATA_NAME,
        self::IS_VALID => self::IS_VALID_DATA_NAME,
    ];

    // errorMessage
    public const string ERROR_MESSAGE = 'errorMessage';
    protected const string ERROR_MESSAGE_DATA_NAME = 'ERROR_MESSAGE';
    protected const int ERROR_MESSAGE_DATA_INDEX = 0;

    public ?string $errorMessage {
        get => $this->_data[self::ERROR_MESSAGE_DATA_INDEX];
        set => $this->_data[self::ERROR_MESSAGE_DATA_INDEX] = $value;
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
