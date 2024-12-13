<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 *
 * Generated on 2024-12-10 21:10:30
 */
final class DefinitionPropertyTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::PROPERTY_NAME => self::PROPERTY_NAME_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
        self::COLLECTION_TYPE => self::COLLECTION_TYPE_DATA_NAME,
    ];

    // className
    public const string PROPERTY_NAME = 'propertyName';
    protected const string PROPERTY_NAME_DATA_NAME = 'PROPERTY_NAME';
    protected const int PROPERTY_NAME_DATA_INDEX = 0;

    public ?string $propertyName {
        get => $this->data[self::PROPERTY_NAME_DATA_INDEX];
        set => $this->data[self::PROPERTY_NAME_DATA_INDEX] = $value;
    }

    // className
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 1;

    public ?string $type {
        get => $this->data[self::TYPE_DATA_INDEX];
        set => $this->data[self::TYPE_DATA_INDEX] = $value;
    }

    // className
    public const string COLLECTION_TYPE = 'collectionType';
    protected const string COLLECTION_TYPE_DATA_NAME = 'COLLECTION_TYPE';
    protected const int COLLECTION_TYPE_DATA_INDEX = 2;

    public ?string $collectionType {
        get => $this->data[self::COLLECTION_TYPE_DATA_INDEX];
        set => $this->data[self::COLLECTION_TYPE_DATA_INDEX] = $value;
    }
}
