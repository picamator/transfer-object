<?php declare(strict_types = 1);

namespace Picamator\TransferGenerator\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class GeneratorTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::DEFINITION_KEY => self::DEFINITION_KEY_DATA_NAME,
        self::VALIDATOR => self::VALIDATOR_DATA_NAME,
    ];

    // definitionKey
    public const string DEFINITION_KEY = 'definitionKey';
    protected const string DEFINITION_KEY_DATA_NAME = 'DEFINITION_KEY';
    protected const int DEFINITION_KEY_DATA_INDEX = 0;

    public ?string $definitionKey {
        get => $this->_data[self::DEFINITION_KEY_DATA_INDEX];
        set => $this->_data[self::DEFINITION_KEY_DATA_INDEX] = $value;
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
