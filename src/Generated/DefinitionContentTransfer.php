<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class DefinitionContentTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CLASS_NAME => self::CLASS_NAME_DATA_NAME,
        self::PROPERTIES => self::PROPERTIES_DATA_NAME,
    ];

    // className
    public const string CLASS_NAME = 'className';
    protected const string CLASS_NAME_DATA_NAME = 'CLASS_NAME';
    protected const int CLASS_NAME_DATA_INDEX = 0;

    public string $className {
        get => $this->getRequiredData(self::CLASS_NAME_DATA_INDEX);
        set => $this->setData(self::CLASS_NAME_DATA_INDEX, $value);
    }

    // properties
    #[CollectionPropertyTypeAttribute(DefinitionPropertyTransfer::class)]
    public const string PROPERTIES = 'properties';
    protected const string PROPERTIES_DATA_NAME = 'PROPERTIES';
    protected const int PROPERTIES_DATA_INDEX = 1;

    /** @var \ArrayObject<int,DefinitionPropertyTransfer> */
    public ArrayObject $properties {
        get => $this->getRequiredData(self::PROPERTIES_DATA_INDEX);
        set => $this->setData(self::PROPERTIES_DATA_INDEX, $value);
    }
}
