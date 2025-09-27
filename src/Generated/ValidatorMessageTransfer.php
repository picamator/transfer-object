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
        self::ERROR_MESSAGE_INDEX => self::ERROR_MESSAGE,
        self::IS_VALID_INDEX => self::IS_VALID,
    ];

    // errorMessage
    public const string ERROR_MESSAGE = 'errorMessage';
    private const int ERROR_MESSAGE_INDEX = 0;

    public protected(set) string $errorMessage {
        get => $this->getData(self::ERROR_MESSAGE_INDEX);
        set => $this->setData(self::ERROR_MESSAGE_INDEX, $value);
    }

    // isValid
    public const string IS_VALID = 'isValid';
    private const int IS_VALID_INDEX = 1;

    public protected(set) bool $isValid {
        get => $this->getData(self::IS_VALID_INDEX);
        set => $this->setData(self::IS_VALID_INDEX, $value);
    }
}
