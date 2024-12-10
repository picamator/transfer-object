<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 *
 * Generated on 2024-12-10 21:10:30
 */
final class DefinitionValidatorTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ERROR_MESSAGES => self::ERROR_MESSAGES_DATA_NAME,
        self::IS_VALID => self::IS_VALID_DATA_NAME,
    ];

    // errorMessages
    #[CollectionPropertyTypeAttribute(ErrorMessageTransfer::class)]
    public const string ERROR_MESSAGES = 'errorMessages';
    protected const string ERROR_MESSAGES_DATA_NAME = 'ERROR_MESSAGES';
    protected const int ERROR_MESSAGES_DATA_INDEX = 0;
    
    /** @var \ArrayObject<ErrorMessageTransfer>|null */
    public ?ArrayObject $errorMessages {
        get => $this->data[self::ERROR_MESSAGES_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::ERROR_MESSAGES_DATA_INDEX] = $value;
    }

    // isValid
    public const string IS_VALID = 'isValid';
    protected const string IS_VALID_DATA_NAME = 'IS_VALID';
    protected const int IS_VALID_DATA_INDEX = 1;
    
    public ?bool $isValid {
        get => $this->data[self::IS_VALID_DATA_INDEX];
        set => $this->data[self::IS_VALID_DATA_INDEX] = $value;
    }
}
