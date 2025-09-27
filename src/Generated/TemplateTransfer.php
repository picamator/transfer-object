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
        self::ATTRIBUTES_INDEX => self::ATTRIBUTES,
        self::CLASS_NAME_INDEX => self::CLASS_NAME,
        self::CLASS_NAMESPACE_INDEX => self::CLASS_NAMESPACE,
        self::DEFINITION_PATH_INDEX => self::DEFINITION_PATH,
        self::DOCK_BLOCKS_INDEX => self::DOCK_BLOCKS,
        self::IMPORTS_INDEX => self::IMPORTS,
        self::META_CONSTANTS_INDEX => self::META_CONSTANTS,
        self::NULLABLES_INDEX => self::NULLABLES,
        self::PROPERTIES_INDEX => self::PROPERTIES,
        self::PROTECTS_INDEX => self::PROTECTS,
    ];

    // attributes
    #[ArrayObjectPropertyTypeAttribute]
    public const string ATTRIBUTES = 'attributes';
    private const int ATTRIBUTES_INDEX = 0;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $attributes {
        get => $this->getData(self::ATTRIBUTES_INDEX);
        set => $this->setData(self::ATTRIBUTES_INDEX, $value);
    }

    // className
    public const string CLASS_NAME = 'className';
    private const int CLASS_NAME_INDEX = 1;

    public string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set => $this->setData(self::CLASS_NAME_INDEX, $value);
    }

    // classNamespace
    public const string CLASS_NAMESPACE = 'classNamespace';
    private const int CLASS_NAMESPACE_INDEX = 2;

    public string $classNamespace {
        get => $this->getData(self::CLASS_NAMESPACE_INDEX);
        set => $this->setData(self::CLASS_NAMESPACE_INDEX, $value);
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    private const int DEFINITION_PATH_INDEX = 3;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_INDEX);
        set => $this->setData(self::DEFINITION_PATH_INDEX, $value);
    }

    // dockBlocks
    #[ArrayObjectPropertyTypeAttribute]
    public const string DOCK_BLOCKS = 'dockBlocks';
    private const int DOCK_BLOCKS_INDEX = 4;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $dockBlocks {
        get => $this->getData(self::DOCK_BLOCKS_INDEX);
        set => $this->setData(self::DOCK_BLOCKS_INDEX, $value);
    }

    // imports
    #[ArrayObjectPropertyTypeAttribute]
    public const string IMPORTS = 'imports';
    private const int IMPORTS_INDEX = 5;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $imports {
        get => $this->getData(self::IMPORTS_INDEX);
        set => $this->setData(self::IMPORTS_INDEX, $value);
    }

    // metaConstants
    #[ArrayObjectPropertyTypeAttribute]
    public const string META_CONSTANTS = 'metaConstants';
    private const int META_CONSTANTS_INDEX = 6;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $metaConstants {
        get => $this->getData(self::META_CONSTANTS_INDEX);
        set => $this->setData(self::META_CONSTANTS_INDEX, $value);
    }

    // nullables
    #[ArrayObjectPropertyTypeAttribute]
    public const string NULLABLES = 'nullables';
    private const int NULLABLES_INDEX = 7;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $nullables {
        get => $this->getData(self::NULLABLES_INDEX);
        set => $this->setData(self::NULLABLES_INDEX, $value);
    }

    // properties
    #[ArrayObjectPropertyTypeAttribute]
    public const string PROPERTIES = 'properties';
    private const int PROPERTIES_INDEX = 8;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $properties {
        get => $this->getData(self::PROPERTIES_INDEX);
        set => $this->setData(self::PROPERTIES_INDEX, $value);
    }

    // protects
    #[ArrayObjectPropertyTypeAttribute]
    public const string PROTECTS = 'protects';
    private const int PROTECTS_INDEX = 9;

    /** @var \ArrayObject<string|int,mixed> */
    public ArrayObject $protects {
        get => $this->getData(self::PROTECTS_INDEX);
        set => $this->setData(self::PROTECTS_INDEX, $value);
    }
}
