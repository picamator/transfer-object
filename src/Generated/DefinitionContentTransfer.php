<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\CollectionInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class DefinitionContentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::CLASS_NAME => self::CLASS_NAME_INDEX,
        self::PROPERTIES => self::PROPERTIES_INDEX,
    ];

    // className
    public const string CLASS_NAME = 'className';
    private const int CLASS_NAME_INDEX = 0;

    public string $className {
        get => $this->getData(self::CLASS_NAME_INDEX);
        set => $this->setData(self::CLASS_NAME_INDEX, $value);
    }

    // properties
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(DefinitionPropertyTransfer::class)]
    public const string PROPERTIES = 'properties';
    private const int PROPERTIES_INDEX = 1;

    /** @var \ArrayObject<int,DefinitionPropertyTransfer> */
    public ArrayObject $properties {
        get => $this->getData(self::PROPERTIES_INDEX);
        set => $this->setData(self::PROPERTIES_INDEX, $value);
    }
}
