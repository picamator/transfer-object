<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuildInTypeEnum;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\EnumPropertyTypeAttribute;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DefinitionPropertyTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::BUILD_IN_TYPE => self::BUILD_IN_TYPE_DATA_NAME,
        self::COLLECTION_TYPE => self::COLLECTION_TYPE_DATA_NAME,
        self::ENUM_TYPE => self::ENUM_TYPE_DATA_NAME,
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
    public const string COLLECTION_TYPE = 'collectionType';
    protected const string COLLECTION_TYPE_DATA_NAME = 'COLLECTION_TYPE';
    protected const int COLLECTION_TYPE_DATA_INDEX = 1;

    public ?string $collectionType {
        get => $this->getData(self::COLLECTION_TYPE_DATA_INDEX);
        set => $this->setData(self::COLLECTION_TYPE_DATA_INDEX, $value);
    }

    // enumType
    public const string ENUM_TYPE = 'enumType';
    protected const string ENUM_TYPE_DATA_NAME = 'ENUM_TYPE';
    protected const int ENUM_TYPE_DATA_INDEX = 2;

    public ?string $enumType {
        get => $this->getData(self::ENUM_TYPE_DATA_INDEX);
        set => $this->setData(self::ENUM_TYPE_DATA_INDEX, $value);
    }

    // propertyName
    public const string PROPERTY_NAME = 'propertyName';
    protected const string PROPERTY_NAME_DATA_NAME = 'PROPERTY_NAME';
    protected const int PROPERTY_NAME_DATA_INDEX = 3;

    public ?string $propertyName {
        get => $this->getData(self::PROPERTY_NAME_DATA_INDEX);
        set => $this->setData(self::PROPERTY_NAME_DATA_INDEX, $value);
    }

    // transferType
    public const string TRANSFER_TYPE = 'transferType';
    protected const string TRANSFER_TYPE_DATA_NAME = 'TRANSFER_TYPE';
    protected const int TRANSFER_TYPE_DATA_INDEX = 4;

    public ?string $transferType {
        get => $this->getData(self::TRANSFER_TYPE_DATA_INDEX);
        set => $this->setData(self::TRANSFER_TYPE_DATA_INDEX, $value);
    }
}
