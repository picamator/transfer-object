<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DefinitionPropertyTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 6;

    protected const array META_DATA = [
        self::BUILD_IN_TYPE => self::BUILD_IN_TYPE_DATA_NAME,
        self::COLLECTION_TYPE => self::COLLECTION_TYPE_DATA_NAME,
        self::ENUM_TYPE => self::ENUM_TYPE_DATA_NAME,
        self::IS_NULLABLE => self::IS_NULLABLE_DATA_NAME,
        self::PROPERTY_NAME => self::PROPERTY_NAME_DATA_NAME,
        self::TRANSFER_TYPE => self::TRANSFER_TYPE_DATA_NAME,
    ];

    // buildInType
    #[EnumPropertyTypeAttribute(BuildInTypeEnum::class)]
    public const string BUILD_IN_TYPE = 'buildInType';
    protected const string BUILD_IN_TYPE_DATA_NAME = 'BUILD_IN_TYPE';
    protected const int BUILD_IN_TYPE_DATA_INDEX = 0;

    public ?BuildInTypeEnum $buildInType {
        get => $this->getData(self::BUILD_IN_TYPE_DATA_INDEX);
        set => $this->setData(self::BUILD_IN_TYPE_DATA_INDEX, $value);
    }

    // collectionType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string COLLECTION_TYPE = 'collectionType';
    protected const string COLLECTION_TYPE_DATA_NAME = 'COLLECTION_TYPE';
    protected const int COLLECTION_TYPE_DATA_INDEX = 1;

    public ?DefinitionEmbeddedTypeTransfer $collectionType {
        get => $this->getData(self::COLLECTION_TYPE_DATA_INDEX);
        set => $this->setData(self::COLLECTION_TYPE_DATA_INDEX, $value);
    }

    // enumType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string ENUM_TYPE = 'enumType';
    protected const string ENUM_TYPE_DATA_NAME = 'ENUM_TYPE';
    protected const int ENUM_TYPE_DATA_INDEX = 2;

    public ?DefinitionEmbeddedTypeTransfer $enumType {
        get => $this->getData(self::ENUM_TYPE_DATA_INDEX);
        set => $this->setData(self::ENUM_TYPE_DATA_INDEX, $value);
    }

    // isNullable
    public const string IS_NULLABLE = 'isNullable';
    protected const string IS_NULLABLE_DATA_NAME = 'IS_NULLABLE';
    protected const int IS_NULLABLE_DATA_INDEX = 3;

    public bool $isNullable {
        get => $this->getRequiredData(self::IS_NULLABLE_DATA_INDEX);
        set => $this->setData(self::IS_NULLABLE_DATA_INDEX, $value);
    }

    // propertyName
    public const string PROPERTY_NAME = 'propertyName';
    protected const string PROPERTY_NAME_DATA_NAME = 'PROPERTY_NAME';
    protected const int PROPERTY_NAME_DATA_INDEX = 4;

    public string $propertyName {
        get => $this->getRequiredData(self::PROPERTY_NAME_DATA_INDEX);
        set => $this->setData(self::PROPERTY_NAME_DATA_INDEX, $value);
    }

    // transferType
    #[PropertyTypeAttribute(DefinitionEmbeddedTypeTransfer::class)]
    public const string TRANSFER_TYPE = 'transferType';
    protected const string TRANSFER_TYPE_DATA_NAME = 'TRANSFER_TYPE';
    protected const int TRANSFER_TYPE_DATA_INDEX = 5;

    public ?DefinitionEmbeddedTypeTransfer $transferType {
        get => $this->getData(self::TRANSFER_TYPE_DATA_INDEX);
        set => $this->setData(self::TRANSFER_TYPE_DATA_INDEX, $value);
    }
}
