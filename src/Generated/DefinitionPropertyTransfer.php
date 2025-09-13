<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

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
    protected const int META_DATA_SIZE = 9;

    protected const array META_DATA = [
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

    // buildInType
    #[EnumPropertyTypeAttribute(BuildInTypeEnum::class)]
    public const string BUILD_IN_TYPE = 'buildInType';
    protected const int BUILD_IN_TYPE_INDEX = 0;

    public ?BuildInTypeEnum $buildInType {
        get => $this->getData(self::BUILD_IN_TYPE_INDEX);
        set => $this->setData(self::BUILD_IN_TYPE_INDEX, $value);
    }

    // collectionType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string COLLECTION_TYPE = 'collectionType';
    protected const int COLLECTION_TYPE_INDEX = 1;

    public ?DefinitionEmbeddedTypeTransfer $collectionType {
        get => $this->getData(self::COLLECTION_TYPE_INDEX);
        set => $this->setData(self::COLLECTION_TYPE_INDEX, $value);
    }

    // dateTimeType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string DATE_TIME_TYPE = 'dateTimeType';
    protected const int DATE_TIME_TYPE_INDEX = 2;

    public ?DefinitionEmbeddedTypeTransfer $dateTimeType {
        get => $this->getData(self::DATE_TIME_TYPE_INDEX);
        set => $this->setData(self::DATE_TIME_TYPE_INDEX, $value);
    }

    // enumType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string ENUM_TYPE = 'enumType';
    protected const int ENUM_TYPE_INDEX = 3;

    public ?DefinitionEmbeddedTypeTransfer $enumType {
        get => $this->getData(self::ENUM_TYPE_INDEX);
        set => $this->setData(self::ENUM_TYPE_INDEX, $value);
    }

    // isNullable
    public const string IS_NULLABLE = 'isNullable';
    protected const int IS_NULLABLE_INDEX = 4;

    public bool $isNullable {
        get => $this->getData(self::IS_NULLABLE_INDEX);
        set => $this->setData(self::IS_NULLABLE_INDEX, $value);
    }

    // isProtected
    public const string IS_PROTECTED = 'isProtected';
    protected const int IS_PROTECTED_INDEX = 5;

    public bool $isProtected {
        get => $this->getData(self::IS_PROTECTED_INDEX);
        set => $this->setData(self::IS_PROTECTED_INDEX, $value);
    }

    // numberType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string NUMBER_TYPE = 'numberType';
    protected const int NUMBER_TYPE_INDEX = 6;

    public ?DefinitionEmbeddedTypeTransfer $numberType {
        get => $this->getData(self::NUMBER_TYPE_INDEX);
        set => $this->setData(self::NUMBER_TYPE_INDEX, $value);
    }

    // propertyName
    public const string PROPERTY_NAME = 'propertyName';
    protected const int PROPERTY_NAME_INDEX = 7;

    public string $propertyName {
        get => $this->getData(self::PROPERTY_NAME_INDEX);
        set => $this->setData(self::PROPERTY_NAME_INDEX, $value);
    }

    // transferType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string TRANSFER_TYPE = 'transferType';
    protected const int TRANSFER_TYPE_INDEX = 8;

    public ?DefinitionEmbeddedTypeTransfer $transferType {
        get => $this->getData(self::TRANSFER_TYPE_INDEX);
        set => $this->setData(self::TRANSFER_TYPE_INDEX, $value);
    }
}
