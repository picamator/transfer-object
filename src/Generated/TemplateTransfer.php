<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\ArrayObjectTransformerAttribute;

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
    protected const int META_DATA_SIZE = 11;

    protected const array META_DATA = [
        self::CLASS_NAME_INDEX => self::CLASS_NAME,
        self::CLASS_NAMESPACE_INDEX => self::CLASS_NAMESPACE,
        self::DEFINITION_PATH_INDEX => self::DEFINITION_PATH,
        self::DOCK_BLOCKS_INDEX => self::DOCK_BLOCKS,
        self::IMPORTS_INDEX => self::IMPORTS,
        self::META_ATTRIBUTES_INDEX => self::META_ATTRIBUTES,
        self::META_CONSTANTS_INDEX => self::META_CONSTANTS,
        self::NULLABLES_INDEX => self::NULLABLES,
        self::PROPERTIES_INDEX => self::PROPERTIES,
        self::PROPERTY_ATTRIBUTES_INDEX => self::PROPERTY_ATTRIBUTES,
        self::PROTECTS_INDEX => self::PROTECTS,
    ];

    // className
    public const string CLASS_NAME = 'className';
    private const int CLASS_NAME_INDEX = 0;

    public string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set => $this->setData(self::CLASS_NAME_INDEX, $value);
    }

    // classNamespace
    public const string CLASS_NAMESPACE = 'classNamespace';
    private const int CLASS_NAMESPACE_INDEX = 1;

    public string $classNamespace {
        get => $this->getData(self::CLASS_NAMESPACE_INDEX);
        set => $this->setData(self::CLASS_NAMESPACE_INDEX, $value);
    }

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    private const int DEFINITION_PATH_INDEX = 2;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_INDEX);
        set => $this->setData(self::DEFINITION_PATH_INDEX, $value);
    }

    // dockBlocks
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string DOCK_BLOCKS = 'dockBlocks';
    private const int DOCK_BLOCKS_INDEX = 3;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $dockBlocks {
        get => $this->getData(self::DOCK_BLOCKS_INDEX);
        set => $this->setData(self::DOCK_BLOCKS_INDEX, $value);
    }

    // imports
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string IMPORTS = 'imports';
    private const int IMPORTS_INDEX = 4;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $imports {
        get => $this->getData(self::IMPORTS_INDEX);
        set => $this->setData(self::IMPORTS_INDEX, $value);
    }

    // metaAttributes
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string META_ATTRIBUTES = 'metaAttributes';
    private const int META_ATTRIBUTES_INDEX = 5;

    /** @var \ArrayObject<string,array<int,string>> */
    public ArrayObject $metaAttributes {
        get => $this->getData(self::META_ATTRIBUTES_INDEX);
        set => $this->setData(self::META_ATTRIBUTES_INDEX, $value);
    }

    // metaConstants
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string META_CONSTANTS = 'metaConstants';
    private const int META_CONSTANTS_INDEX = 6;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $metaConstants {
        get => $this->getData(self::META_CONSTANTS_INDEX);
        set => $this->setData(self::META_CONSTANTS_INDEX, $value);
    }

    // nullables
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string NULLABLES = 'nullables';
    private const int NULLABLES_INDEX = 7;

    /** @var \ArrayObject<string,bool> */
    public ArrayObject $nullables {
        get => $this->getData(self::NULLABLES_INDEX);
        set => $this->setData(self::NULLABLES_INDEX, $value);
    }

    // properties
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string PROPERTIES = 'properties';
    private const int PROPERTIES_INDEX = 8;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $properties {
        get => $this->getData(self::PROPERTIES_INDEX);
        set => $this->setData(self::PROPERTIES_INDEX, $value);
    }

    // propertyAttributes
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string PROPERTY_ATTRIBUTES = 'propertyAttributes';
    private const int PROPERTY_ATTRIBUTES_INDEX = 9;

    /** @var \ArrayObject<string,array<int,string>> */
    public ArrayObject $propertyAttributes {
        get => $this->getData(self::PROPERTY_ATTRIBUTES_INDEX);
        set => $this->setData(self::PROPERTY_ATTRIBUTES_INDEX, $value);
    }

    // protects
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string PROTECTS = 'protects';
    private const int PROTECTS_INDEX = 10;

    /** @var \ArrayObject<string,bool> */
    public ArrayObject $protects {
        get => $this->getData(self::PROTECTS_INDEX);
        set => $this->setData(self::PROTECTS_INDEX, $value);
    }
}
