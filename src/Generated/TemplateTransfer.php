<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator-template.transfer.yml Definition file path.
 */
final class TemplateTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 10;

    protected const array META_DATA = [
        self::ATTRIBUTES => self::ATTRIBUTES_DATA_NAME,
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::CLASS_NAMESPACE => self::CLASS_NAMESPACE_DATA_NAME,
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
        self::DOCK_BLOCKS => self::DOCK_BLOCKS_DATA_NAME,
        self::IMPORTS => self::IMPORTS_DATA_NAME,
        self::META_CONSTANTS => self::META_CONSTANTS_DATA_NAME,
        self::NULLABLES => self::NULLABLES_DATA_NAME,
        self::PROPERTIES => self::PROPERTIES_DATA_NAME,
        self::PROTECTS => self::PROTECTS_DATA_NAME,
    ];

    // attributes
    #[ArrayObjectPropertyTypeAttribute]
    public const string ATTRIBUTES = 'attributes';
    protected const string ATTRIBUTES_DATA_NAME = 'ATTRIBUTES';
    protected const int ATTRIBUTES_DATA_INDEX = 0;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $attributes {
        get => $this->_data[self::ATTRIBUTES_DATA_INDEX];
        set => $this->_data[self::ATTRIBUTES_DATA_INDEX] = $value;
    }

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 1;

    public string $className {
        get => $this->_data[self::CLASS_NAME_DATA_INDEX];
        set => $this->_data[self::CLASS_NAME_DATA_INDEX] = $value;
    }

    // classNamespace
    public const string CLASS_NAMESPACE = 'classNamespace';
    protected const string CLASS_NAMESPACE_DATA_NAME = 'CLASS_NAMESPACE';
    protected const int CLASS_NAMESPACE_DATA_INDEX = 2;

    public string $classNamespace {
        get => $this->_data[self::CLASS_NAMESPACE_DATA_INDEX];
        set => $this->_data[self::CLASS_NAMESPACE_DATA_INDEX] = $value;
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    protected const string DEFINITION_PATH_DATA_NAME = 'DEFINITION_PATH';
    protected const int DEFINITION_PATH_DATA_INDEX = 3;

    public string $definitionPath {
        get => $this->_data[self::DEFINITION_PATH_DATA_INDEX];
        set => $this->_data[self::DEFINITION_PATH_DATA_INDEX] = $value;
    }

    // dockBlocks
    #[ArrayObjectPropertyTypeAttribute]
    public const string DOCK_BLOCKS = 'dockBlocks';
    protected const string DOCK_BLOCKS_DATA_NAME = 'DOCK_BLOCKS';
    protected const int DOCK_BLOCKS_DATA_INDEX = 4;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $dockBlocks {
        get => $this->_data[self::DOCK_BLOCKS_DATA_INDEX];
        set => $this->_data[self::DOCK_BLOCKS_DATA_INDEX] = $value;
    }

    // imports
    #[ArrayObjectPropertyTypeAttribute]
    public const string IMPORTS = 'imports';
    protected const string IMPORTS_DATA_NAME = 'IMPORTS';
    protected const int IMPORTS_DATA_INDEX = 5;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $imports {
        get => $this->_data[self::IMPORTS_DATA_INDEX];
        set => $this->_data[self::IMPORTS_DATA_INDEX] = $value;
    }

    // metaConstants
    #[ArrayObjectPropertyTypeAttribute]
    public const string META_CONSTANTS = 'metaConstants';
    protected const string META_CONSTANTS_DATA_NAME = 'META_CONSTANTS';
    protected const int META_CONSTANTS_DATA_INDEX = 6;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $metaConstants {
        get => $this->_data[self::META_CONSTANTS_DATA_INDEX];
        set => $this->_data[self::META_CONSTANTS_DATA_INDEX] = $value;
    }

    // nullables
    #[ArrayObjectPropertyTypeAttribute]
    public const string NULLABLES = 'nullables';
    protected const string NULLABLES_DATA_NAME = 'NULLABLES';
    protected const int NULLABLES_DATA_INDEX = 7;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $nullables {
        get => $this->_data[self::NULLABLES_DATA_INDEX];
        set => $this->_data[self::NULLABLES_DATA_INDEX] = $value;
    }

    // properties
    #[ArrayObjectPropertyTypeAttribute]
    public const string PROPERTIES = 'properties';
    protected const string PROPERTIES_DATA_NAME = 'PROPERTIES';
    protected const int PROPERTIES_DATA_INDEX = 8;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $properties {
        get => $this->_data[self::PROPERTIES_DATA_INDEX];
        set => $this->_data[self::PROPERTIES_DATA_INDEX] = $value;
    }

    // protects
    #[ArrayObjectPropertyTypeAttribute]
    public const string PROTECTS = 'protects';
    protected const string PROTECTS_DATA_NAME = 'PROTECTS';
    protected const int PROTECTS_DATA_INDEX = 9;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $protects {
        get => $this->_data[self::PROTECTS_DATA_INDEX];
        set => $this->_data[self::PROTECTS_DATA_INDEX] = $value;
    }
}
