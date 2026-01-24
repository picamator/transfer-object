<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use ArrayObject;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\ItemTransfer;
use Picamator\Tests\Integration\TransferObject\Transfer\Generated\RequiredTransfer as RequiredAlias;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/namespace.transfer.yml Definition file path.
 */
final class NamespaceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ITEMS_PROP => self::ITEMS_INDEX,
        self::REQUIRED_PROP => self::REQUIRED_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::ITEMS_PROP => 'ITEMS_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::ITEMS_PROP => 'ITEMS_PROP',
        self::REQUIRED_PROP => 'REQUIRED_PROP',
    ];

    // items
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(ItemTransfer::class)]
    public const string ITEMS_PROP = 'items';
    private const int ITEMS_INDEX = 0;

    /** @var \ArrayObject<int,TransferInterface&ItemTransfer> */
    public ArrayObject $items {
        get => $this->getData(self::ITEMS_INDEX);
        set {
            $this->setData(self::ITEMS_INDEX, $value);
        }
    }

    // required
    #[TransferTransformerAttribute(RequiredAlias::class)]
    public const string REQUIRED_PROP = 'required';
    private const int REQUIRED_INDEX = 1;

    public TransferInterface&RequiredAlias $required {
        get => $this->getData(self::REQUIRED_INDEX);
        set {
            $this->setData(self::REQUIRED_INDEX, $value);
        }
    }
}
