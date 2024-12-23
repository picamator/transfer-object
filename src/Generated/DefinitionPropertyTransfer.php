<?php

declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class DefinitionPropertyTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::BUILD_IN_TYPE => self::BUILD_IN_TYPE_DATA_NAME,
        self::COLLECTION_TYPE => self::COLLECTION_TYPE_DATA_NAME,
        self::PROPERTY_NAME => self::PROPERTY_NAME_DATA_NAME,
        self::TRANSFER_TYPE => self::TRANSFER_TYPE_DATA_NAME,
    ];

    // buildInType
    public const string BUILD_IN_TYPE = 'buildInType';
    protected const string BUILD_IN_TYPE_DATA_NAME = 'BUILD_IN_TYPE';
    protected const int BUILD_IN_TYPE_DATA_INDEX = 0;

    public ?string $buildInType {
        get => $this->_data[self::BUILD_IN_TYPE_DATA_INDEX];
        set => $this->_data[self::BUILD_IN_TYPE_DATA_INDEX] = $value;
    }

    // collectionType
    public const string COLLECTION_TYPE = 'collectionType';
    protected const string COLLECTION_TYPE_DATA_NAME = 'COLLECTION_TYPE';
    protected const int COLLECTION_TYPE_DATA_INDEX = 1;

    public ?string $collectionType {
        get => $this->_data[self::COLLECTION_TYPE_DATA_INDEX];
        set => $this->_data[self::COLLECTION_TYPE_DATA_INDEX] = $value;
    }

    // propertyName
    public const string PROPERTY_NAME = 'propertyName';
    protected const string PROPERTY_NAME_DATA_NAME = 'PROPERTY_NAME';
    protected const int PROPERTY_NAME_DATA_INDEX = 2;

    public ?string $propertyName {
        get => $this->_data[self::PROPERTY_NAME_DATA_INDEX];
        set => $this->_data[self::PROPERTY_NAME_DATA_INDEX] = $value;
    }

    // transferType
    public const string TRANSFER_TYPE = 'transferType';
    protected const string TRANSFER_TYPE_DATA_NAME = 'TRANSFER_TYPE';
    protected const int TRANSFER_TYPE_DATA_INDEX = 3;

    public ?string $transferType {
        get => $this->_data[self::TRANSFER_TYPE_DATA_INDEX];
        set => $this->_data[self::TRANSFER_TYPE_DATA_INDEX] = $value;
    }
}
