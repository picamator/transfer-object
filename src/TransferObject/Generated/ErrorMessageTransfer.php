<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 *
 * Generated on 2024-12-10 21:10:30
 */
final class ErrorMessageTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CONTEXT => self::CONTEXT_DATA_NAME,
        self::MESSAGE => self::MESSAGE_DATA_NAME,
    ];

    // context
    public const string CONTEXT = 'context';
    protected const string CONTEXT_DATA_NAME = 'CONTEXT';
    protected const int CONTEXT_DATA_INDEX = 0;
    
    public ?array $context {
        get => $this->data[self::CONTEXT_DATA_INDEX] ?? [];
        set => $this->data[self::CONTEXT_DATA_INDEX] = $value;
    }

    // message
    public const string MESSAGE = 'message';
    protected const string MESSAGE_DATA_NAME = 'MESSAGE';
    protected const int MESSAGE_DATA_INDEX = 1;
    
    public ?string $message {
        get => $this->data[self::MESSAGE_DATA_INDEX];
        set => $this->data[self::MESSAGE_DATA_INDEX] = $value;
    }
}
