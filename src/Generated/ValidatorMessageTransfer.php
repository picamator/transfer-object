<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/shared.transfer.yml Definition file path.
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

    public protected(set) string $errorMessage {
        get => $this->_data[self::ERROR_MESSAGE_DATA_INDEX];
        set => $this->_data[self::ERROR_MESSAGE_DATA_INDEX] = $value;
    }

    // isValid
    public const string IS_VALID = 'isValid';
    protected const string IS_VALID_DATA_NAME = 'IS_VALID';
    protected const int IS_VALID_DATA_INDEX = 1;

    public protected(set) bool $isValid {
        get => $this->_data[self::IS_VALID_DATA_INDEX];
        set => $this->_data[self::IS_VALID_DATA_INDEX] = $value;
    }
}
