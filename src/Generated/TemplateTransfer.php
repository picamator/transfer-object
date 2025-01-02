<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayObjectPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class TemplateTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 9;

    protected const array META_DATA = [
        self::ATTRIBUTES => self::ATTRIBUTES_DATA_NAME,
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::CLASS_NAMESPACE => self::CLASS_NAMESPACE_DATA_NAME,
        self::DOCK_BLOCKS => self::DOCK_BLOCKS_DATA_NAME,
        self::IMPORTS => self::IMPORTS_DATA_NAME,
        self::META_CONSTANTS => self::META_CONSTANTS_DATA_NAME,
        self::NULLABLES => self::NULLABLES_DATA_NAME,
        self::PROPERTIES => self::PROPERTIES_DATA_NAME,
        self::PROPERTIES_COUNT => self::PROPERTIES_COUNT_DATA_NAME,
    ];

    // attributes
    #[ArrayObjectPropertyTypeAttribute]
    public const string ATTRIBUTES = 'attributes';
    protected const string ATTRIBUTES_DATA_NAME = 'ATTRIBUTES';
    protected const int ATTRIBUTES_DATA_INDEX = 0;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $attributes {
        get => $this->getRequiredData(self::ATTRIBUTES_DATA_INDEX);
        set => $this->setData(self::ATTRIBUTES_DATA_INDEX, $value);
    }

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 1;

    public string $className {
        get => $this->getRequiredData(self::CLASS_NAME_DATA_INDEX);
        set => $this->setData(self::CLASS_NAME_DATA_INDEX, $value);
    }

    // classNamespace
    public const string CLASS_NAMESPACE = 'classNamespace';
    protected const string CLASS_NAMESPACE_DATA_NAME = 'CLASS_NAMESPACE';
    protected const int CLASS_NAMESPACE_DATA_INDEX = 2;

    public string $classNamespace {
        get => $this->getRequiredData(self::CLASS_NAMESPACE_DATA_INDEX);
        set => $this->setData(self::CLASS_NAMESPACE_DATA_INDEX, $value);
    }

    // dockBlocks
    #[ArrayObjectPropertyTypeAttribute]
    public const string DOCK_BLOCKS = 'dockBlocks';
    protected const string DOCK_BLOCKS_DATA_NAME = 'DOCK_BLOCKS';
    protected const int DOCK_BLOCKS_DATA_INDEX = 3;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $dockBlocks {
        get => $this->getRequiredData(self::DOCK_BLOCKS_DATA_INDEX);
        set => $this->setData(self::DOCK_BLOCKS_DATA_INDEX, $value);
    }

    // imports
    #[ArrayObjectPropertyTypeAttribute]
    public const string IMPORTS = 'imports';
    protected const string IMPORTS_DATA_NAME = 'IMPORTS';
    protected const int IMPORTS_DATA_INDEX = 4;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $imports {
        get => $this->getRequiredData(self::IMPORTS_DATA_INDEX);
        set => $this->setData(self::IMPORTS_DATA_INDEX, $value);
    }

    // metaConstants
    #[ArrayObjectPropertyTypeAttribute]
    public const string META_CONSTANTS = 'metaConstants';
    protected const string META_CONSTANTS_DATA_NAME = 'META_CONSTANTS';
    protected const int META_CONSTANTS_DATA_INDEX = 5;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $metaConstants {
        get => $this->getRequiredData(self::META_CONSTANTS_DATA_INDEX);
        set => $this->setData(self::META_CONSTANTS_DATA_INDEX, $value);
    }

    // nullables
    #[ArrayObjectPropertyTypeAttribute]
    public const string NULLABLES = 'nullables';
    protected const string NULLABLES_DATA_NAME = 'NULLABLES';
    protected const int NULLABLES_DATA_INDEX = 6;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $nullables {
        get => $this->getRequiredData(self::NULLABLES_DATA_INDEX);
        set => $this->setData(self::NULLABLES_DATA_INDEX, $value);
    }

    // properties
    #[ArrayObjectPropertyTypeAttribute]
    public const string PROPERTIES = 'properties';
    protected const string PROPERTIES_DATA_NAME = 'PROPERTIES';
    protected const int PROPERTIES_DATA_INDEX = 7;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $properties {
        get => $this->getRequiredData(self::PROPERTIES_DATA_INDEX);
        set => $this->setData(self::PROPERTIES_DATA_INDEX, $value);
    }

    // propertiesCount
    public const string PROPERTIES_COUNT = 'propertiesCount';
    protected const string PROPERTIES_COUNT_DATA_NAME = 'PROPERTIES_COUNT';
    protected const int PROPERTIES_COUNT_DATA_INDEX = 8;

    public int $propertiesCount {
        get => $this->getRequiredData(self::PROPERTIES_COUNT_DATA_INDEX);
        set => $this->setData(self::PROPERTIES_COUNT_DATA_INDEX, $value);
    }
}
