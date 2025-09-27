<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/shared.transfer.yml Definition file path.
 */
final class ValidatorTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ERROR_MESSAGES_INDEX => self::ERROR_MESSAGES,
        self::IS_VALID_INDEX => self::IS_VALID,
    ];

    // errorMessages
    #[CollectionPropertyTypeAttribute(ValidatorMessageTransfer::class)]
    public const string ERROR_MESSAGES = 'errorMessages';
    private const int ERROR_MESSAGES_INDEX = 0;

    /** @var \ArrayObject<int,ValidatorMessageTransfer> */
    public ArrayObject $errorMessages {
        get => $this->getData(self::ERROR_MESSAGES_INDEX);
        set => $this->setData(self::ERROR_MESSAGES_INDEX, $value);
    }

    // isValid
    public const string IS_VALID = 'isValid';
    private const int IS_VALID_INDEX = 1;

    public bool $isValid {
        get => $this->getData(self::IS_VALID_INDEX);
        set => $this->setData(self::IS_VALID_INDEX, $value);
    }
}
