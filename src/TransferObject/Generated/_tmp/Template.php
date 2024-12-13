<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class TemplateTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 8;

    protected const array META_DATA = [
        self::ATTRIBUTES => self::ATTRIBUTES_DATA_NAME,
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::CLASS_NAMESPACE => self::CLASS_NAMESPACE_DATA_NAME,
        self::DOCK_BLOCKS => self::DOCK_BLOCKS_DATA_NAME,
        self::IMPORTS => self::IMPORTS_DATA_NAME,
        self::META_CONSTANTS => self::META_CONSTANTS_DATA_NAME,
        self::PROPERTIES => self::PROPERTIES_DATA_NAME,
        self::PROPERTIES_COUNT => self::PROPERTIES_COUNT_DATA_NAME,
    ];

    // attributes
    public const string ATTRIBUTES = 'attributes';
    protected const string ATTRIBUTES_DATA_NAME = 'ATTRIBUTES';
    protected const int ATTRIBUTES_DATA_INDEX = 0;
    
    public ?ArrayObject $attributes {
        get => $this->data[self::ATTRIBUTES_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::ATTRIBUTES_DATA_INDEX] = $value;
    }

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 1;
    
    public ?string $className {
        get => $this->data[self::CLASS_NAME_DATA_INDEX];
        set => $this->data[self::CLASS_NAME_DATA_INDEX] = $value;
    }

    // classNamespace
    public const string CLASS_NAMESPACE = 'classNamespace';
    protected const string CLASS_NAMESPACE_DATA_NAME = 'CLASS_NAMESPACE';
    protected const int CLASS_NAMESPACE_DATA_INDEX = 2;
    
    public ?string $classNamespace {
        get => $this->data[self::CLASS_NAMESPACE_DATA_INDEX];
        set => $this->data[self::CLASS_NAMESPACE_DATA_INDEX] = $value;
    }

    // dockBlocks
    public const string DOCK_BLOCKS = 'dockBlocks';
    protected const string DOCK_BLOCKS_DATA_NAME = 'DOCK_BLOCKS';
    protected const int DOCK_BLOCKS_DATA_INDEX = 3;
    
    public ?ArrayObject $dockBlocks {
        get => $this->data[self::DOCK_BLOCKS_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::DOCK_BLOCKS_DATA_INDEX] = $value;
    }

    // imports
    public const string IMPORTS = 'imports';
    protected const string IMPORTS_DATA_NAME = 'IMPORTS';
    protected const int IMPORTS_DATA_INDEX = 4;
    
    public ?ArrayObject $imports {
        get => $this->data[self::IMPORTS_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::IMPORTS_DATA_INDEX] = $value;
    }

    // metaConstants
    public const string META_CONSTANTS = 'metaConstants';
    protected const string META_CONSTANTS_DATA_NAME = 'META_CONSTANTS';
    protected const int META_CONSTANTS_DATA_INDEX = 5;
    
    public ?ArrayObject $metaConstants {
        get => $this->data[self::META_CONSTANTS_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::META_CONSTANTS_DATA_INDEX] = $value;
    }

    // properties
    public const string PROPERTIES = 'properties';
    protected const string PROPERTIES_DATA_NAME = 'PROPERTIES';
    protected const int PROPERTIES_DATA_INDEX = 6;
    
    public ?ArrayObject $properties {
        get => $this->data[self::PROPERTIES_DATA_INDEX] ?? new ArrayObject();
        set => $this->data[self::PROPERTIES_DATA_INDEX] = $value;
    }

    // propertiesCount
    public const string PROPERTIES_COUNT = 'propertiesCount';
    protected const string PROPERTIES_COUNT_DATA_NAME = 'PROPERTIES_COUNT';
    protected const int PROPERTIES_COUNT_DATA_INDEX = 7;
    
    public ?int $propertiesCount {
        get => $this->data[self::PROPERTIES_COUNT_DATA_INDEX];
        set => $this->data[self::PROPERTIES_COUNT_DATA_INDEX] = $value;
    }
}
