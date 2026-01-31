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
    protected const int META_DATA_SIZE = 13;

    protected const array META_DATA = [
        self::CLASS_NAME_PROP => self::CLASS_NAME_INDEX,
        self::CLASS_NAMESPACE_PROP => self::CLASS_NAMESPACE_INDEX,
        self::DEFINITION_PATH_PROP => self::DEFINITION_PATH_INDEX,
        self::DOC_BLOCKS_PROP => self::DOC_BLOCKS_INDEX,
        self::IMPORTS_PROP => self::IMPORTS_INDEX,
        self::META_ATTRIBUTES_PROP => self::META_ATTRIBUTES_INDEX,
        self::META_CONSTANTS_PROP => self::META_CONSTANTS_INDEX,
        self::META_INITIATORS_PROP => self::META_INITIATORS_INDEX,
        self::META_TRANSFORMERS_PROP => self::META_TRANSFORMERS_INDEX,
        self::PROPERTIES_PROP => self::PROPERTIES_INDEX,
        self::PROPERTY_ATTRIBUTES_PROP => self::PROPERTY_ATTRIBUTES_INDEX,
        self::PROTECTS_PROP => self::PROTECTS_INDEX,
        self::REQUIRES_PROP => self::REQUIRES_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::DOC_BLOCKS_PROP => 'DOC_BLOCKS_PROP',
        self::IMPORTS_PROP => 'IMPORTS_PROP',
        self::META_ATTRIBUTES_PROP => 'META_ATTRIBUTES_PROP',
        self::META_CONSTANTS_PROP => 'META_CONSTANTS_PROP',
        self::META_INITIATORS_PROP => 'META_INITIATORS_PROP',
        self::META_TRANSFORMERS_PROP => 'META_TRANSFORMERS_PROP',
        self::PROPERTIES_PROP => 'PROPERTIES_PROP',
        self::PROPERTY_ATTRIBUTES_PROP => 'PROPERTY_ATTRIBUTES_PROP',
        self::PROTECTS_PROP => 'PROTECTS_PROP',
        self::REQUIRES_PROP => 'REQUIRES_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::DOC_BLOCKS_PROP => 'DOC_BLOCKS_PROP',
        self::IMPORTS_PROP => 'IMPORTS_PROP',
        self::META_ATTRIBUTES_PROP => 'META_ATTRIBUTES_PROP',
        self::META_CONSTANTS_PROP => 'META_CONSTANTS_PROP',
        self::META_INITIATORS_PROP => 'META_INITIATORS_PROP',
        self::META_TRANSFORMERS_PROP => 'META_TRANSFORMERS_PROP',
        self::PROPERTIES_PROP => 'PROPERTIES_PROP',
        self::PROPERTY_ATTRIBUTES_PROP => 'PROPERTY_ATTRIBUTES_PROP',
        self::PROTECTS_PROP => 'PROTECTS_PROP',
        self::REQUIRES_PROP => 'REQUIRES_PROP',
    ];

    // className
    public const string CLASS_NAME_PROP = 'className';
    private const int CLASS_NAME_INDEX = 0;

    public string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set {
            $this->setData(self::CLASS_NAME_INDEX, $value);
        }
    }

    // classNamespace
    public const string CLASS_NAMESPACE_PROP = 'classNamespace';
    private const int CLASS_NAMESPACE_INDEX = 1;

    public string $classNamespace {
        get => $this->getData(self::CLASS_NAMESPACE_INDEX);
        set {
            $this->setData(self::CLASS_NAMESPACE_INDEX, $value);
        }
    }

    // definitionPath
    public const string DEFINITION_PATH_PROP = 'definitionPath';
    private const int DEFINITION_PATH_INDEX = 2;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_INDEX);
        set {
            $this->setData(self::DEFINITION_PATH_INDEX, $value);
        }
    }

    // docBlocks
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string DOC_BLOCKS_PROP = 'docBlocks';
    private const int DOC_BLOCKS_INDEX = 3;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $docBlocks {
        get => $this->getData(self::DOC_BLOCKS_INDEX);
        set {
            $this->setData(self::DOC_BLOCKS_INDEX, $value);
        }
    }

    // imports
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string IMPORTS_PROP = 'imports';
    private const int IMPORTS_INDEX = 4;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $imports {
        get => $this->getData(self::IMPORTS_INDEX);
        set {
            $this->setData(self::IMPORTS_INDEX, $value);
        }
    }

    // metaAttributes
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string META_ATTRIBUTES_PROP = 'metaAttributes';
    private const int META_ATTRIBUTES_INDEX = 5;

    /** @var \ArrayObject<string,array<int,string>> */
    public ArrayObject $metaAttributes {
        get => $this->getData(self::META_ATTRIBUTES_INDEX);
        set {
            $this->setData(self::META_ATTRIBUTES_INDEX, $value);
        }
    }

    // metaConstants
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string META_CONSTANTS_PROP = 'metaConstants';
    private const int META_CONSTANTS_INDEX = 6;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $metaConstants {
        get => $this->getData(self::META_CONSTANTS_INDEX);
        set {
            $this->setData(self::META_CONSTANTS_INDEX, $value);
        }
    }

    // metaInitiators
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string META_INITIATORS_PROP = 'metaInitiators';
    private const int META_INITIATORS_INDEX = 7;

    /** @var \ArrayObject<int,string> */
    public ArrayObject $metaInitiators {
        get => $this->getData(self::META_INITIATORS_INDEX);
        set {
            $this->setData(self::META_INITIATORS_INDEX, $value);
        }
    }

    // metaTransformers
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string META_TRANSFORMERS_PROP = 'metaTransformers';
    private const int META_TRANSFORMERS_INDEX = 8;

    /** @var \ArrayObject<int,string> */
    public ArrayObject $metaTransformers {
        get => $this->getData(self::META_TRANSFORMERS_INDEX);
        set {
            $this->setData(self::META_TRANSFORMERS_INDEX, $value);
        }
    }

    // properties
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string PROPERTIES_PROP = 'properties';
    private const int PROPERTIES_INDEX = 9;

    /** @var \ArrayObject<string,string> */
    public ArrayObject $properties {
        get => $this->getData(self::PROPERTIES_INDEX);
        set {
            $this->setData(self::PROPERTIES_INDEX, $value);
        }
    }

    // propertyAttributes
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string PROPERTY_ATTRIBUTES_PROP = 'propertyAttributes';
    private const int PROPERTY_ATTRIBUTES_INDEX = 10;

    /** @var \ArrayObject<string,array<int,string>> */
    public ArrayObject $propertyAttributes {
        get => $this->getData(self::PROPERTY_ATTRIBUTES_INDEX);
        set {
            $this->setData(self::PROPERTY_ATTRIBUTES_INDEX, $value);
        }
    }

    // protects
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string PROTECTS_PROP = 'protects';
    private const int PROTECTS_INDEX = 11;

    /** @var \ArrayObject<string,true> */
    public ArrayObject $protects {
        get => $this->getData(self::PROTECTS_INDEX);
        set {
            $this->setData(self::PROTECTS_INDEX, $value);
        }
    }

    // requires
    #[ArrayObjectInitiatorAttribute]
    #[ArrayObjectTransformerAttribute]
    public const string REQUIRES_PROP = 'requires';
    private const int REQUIRES_INDEX = 12;

    /** @var \ArrayObject<string,true> */
    public ArrayObject $requires {
        get => $this->getData(self::REQUIRES_INDEX);
        set {
            $this->setData(self::REQUIRES_INDEX, $value);
        }
    }
}
