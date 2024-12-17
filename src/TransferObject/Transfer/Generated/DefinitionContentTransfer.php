<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Transfer\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class DefinitionContentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::PROPERTIES => self::PROPERTIES_DATA_NAME,
    ];

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 0;

    public ?string $className {
        get => $this->_data[self::CLASS_NAME_DATA_INDEX];
        set => $this->_data[self::CLASS_NAME_DATA_INDEX] = $value;
    }

    // properties
    #[CollectionPropertyTypeAttribute(DefinitionPropertyTransfer::class)]
    public const string PROPERTIES = 'properties';
    protected const string PROPERTIES_DATA_NAME = 'PROPERTIES';
    protected const int PROPERTIES_DATA_INDEX = 1;

    /** @var \ArrayObject<int,DefinitionPropertyTransfer> */
    public ArrayObject $properties {
        get => $this->_data[self::PROPERTIES_DATA_INDEX] ?? new ArrayObject();
        set => $this->_data[self::PROPERTIES_DATA_INDEX] = $value;
    }
}
