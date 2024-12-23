<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class DefinitionTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CONTENT => self::CONTENT_DATA_NAME,
        self::VALIDATOR => self::VALIDATOR_DATA_NAME,
    ];

    // content
    #[PropertyTypeAttribute(DefinitionContentTransfer::class)]
    public const string CONTENT = 'content';
    protected const string CONTENT_DATA_NAME = 'CONTENT';
    protected const int CONTENT_DATA_INDEX = 0;

    public ?DefinitionContentTransfer $content {
        get => $this->_data[self::CONTENT_DATA_INDEX];
        set => $this->_data[self::CONTENT_DATA_INDEX] = $value;
    }

    // validator
    #[PropertyTypeAttribute(DefinitionValidatorTransfer::class)]
    public const string VALIDATOR = 'validator';
    protected const string VALIDATOR_DATA_NAME = 'VALIDATOR';
    protected const int VALIDATOR_DATA_INDEX = 1;

    public ?DefinitionValidatorTransfer $validator {
        get => $this->_data[self::VALIDATOR_DATA_INDEX];
        set => $this->_data[self::VALIDATOR_DATA_INDEX] = $value;
    }
}
