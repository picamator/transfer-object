<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\CollectionInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class DefinitionPropertyTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 10;

    protected const array META_DATA = [
        self::ATTRIBUTES_INDEX => self::ATTRIBUTES,
        self::BUILD_IN_TYPE_INDEX => self::BUILD_IN_TYPE,
        self::COLLECTION_TYPE_INDEX => self::COLLECTION_TYPE,
        self::DATE_TIME_TYPE_INDEX => self::DATE_TIME_TYPE,
        self::ENUM_TYPE_INDEX => self::ENUM_TYPE,
        self::IS_NULLABLE_INDEX => self::IS_NULLABLE,
        self::IS_PROTECTED_INDEX => self::IS_PROTECTED,
        self::NUMBER_TYPE_INDEX => self::NUMBER_TYPE,
        self::PROPERTY_NAME_INDEX => self::PROPERTY_NAME,
        self::TRANSFER_TYPE_INDEX => self::TRANSFER_TYPE,
    ];

    // attributes
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(DefinitionAttributeTransfer::class)]
    public const string ATTRIBUTES = 'attributes';
    private const int ATTRIBUTES_INDEX = 0;

    /** @var \ArrayObject<int,DefinitionAttributeTransfer> */
    public ArrayObject $attributes {
        get => $this->getData(self::ATTRIBUTES_INDEX);
        set => $this->setData(self::ATTRIBUTES_INDEX, $value);
    }

    // buildInType
    #[TransferTransformerAttribute(DefinitionBuildInTypeTransfer::class)]
    public const string BUILD_IN_TYPE = 'buildInType';
    private const int BUILD_IN_TYPE_INDEX = 1;

    public ?DefinitionBuildInTypeTransfer $buildInType {
        get => $this->getData(self::BUILD_IN_TYPE_INDEX);
        set => $this->setData(self::BUILD_IN_TYPE_INDEX, $value);
    }

    // collectionType
    #[TransferTransformerAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string COLLECTION_TYPE = 'collectionType';
    private const int COLLECTION_TYPE_INDEX = 2;

    public ?DefinitionEmbeddedTypeTransfer $collectionType {
        get => $this->getData(self::COLLECTION_TYPE_INDEX);
        set => $this->setData(self::COLLECTION_TYPE_INDEX, $value);
    }

    // dateTimeType
    #[TransferTransformerAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string DATE_TIME_TYPE = 'dateTimeType';
    private const int DATE_TIME_TYPE_INDEX = 3;

    public ?DefinitionEmbeddedTypeTransfer $dateTimeType {
        get => $this->getData(self::DATE_TIME_TYPE_INDEX);
        set => $this->setData(self::DATE_TIME_TYPE_INDEX, $value);
    }

    // enumType
    #[TransferTransformerAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string ENUM_TYPE = 'enumType';
    private const int ENUM_TYPE_INDEX = 4;

    public ?DefinitionEmbeddedTypeTransfer $enumType {
        get => $this->getData(self::ENUM_TYPE_INDEX);
        set => $this->setData(self::ENUM_TYPE_INDEX, $value);
    }

    // isNullable
    public const string IS_NULLABLE = 'isNullable';
    private const int IS_NULLABLE_INDEX = 5;

    public bool $isNullable {
        get => $this->getData(self::IS_NULLABLE_INDEX);
        set => $this->setData(self::IS_NULLABLE_INDEX, $value);
    }

    // isProtected
    public const string IS_PROTECTED = 'isProtected';
    private const int IS_PROTECTED_INDEX = 6;

    public bool $isProtected {
        get => $this->getData(self::IS_PROTECTED_INDEX);
        set => $this->setData(self::IS_PROTECTED_INDEX, $value);
    }

    // numberType
    #[TransferTransformerAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string NUMBER_TYPE = 'numberType';
    private const int NUMBER_TYPE_INDEX = 7;

    public ?DefinitionEmbeddedTypeTransfer $numberType {
        get => $this->getData(self::NUMBER_TYPE_INDEX);
        set => $this->setData(self::NUMBER_TYPE_INDEX, $value);
    }

    // propertyName
    public const string PROPERTY_NAME = 'propertyName';
    private const int PROPERTY_NAME_INDEX = 8;

    public string $propertyName {
        get => $this->getData(self::PROPERTY_NAME_INDEX);
        set => $this->setData(self::PROPERTY_NAME_INDEX, $value);
    }

    // transferType
    #[TransferTransformerAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string TRANSFER_TYPE = 'transferType';
    private const int TRANSFER_TYPE_INDEX = 9;

    public ?DefinitionEmbeddedTypeTransfer $transferType {
        get => $this->getData(self::TRANSFER_TYPE_INDEX);
        set => $this->setData(self::TRANSFER_TYPE_INDEX, $value);
    }
}
