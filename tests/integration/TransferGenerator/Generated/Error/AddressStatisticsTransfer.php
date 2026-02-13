<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Error;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/TransferGenerator/data/config/error/unsupported-type/definition/address-statistics.transfer.yml Definition file path.
 */
final class AddressStatisticsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ADDRESS_BOOK_UUID_PROP => self::ADDRESS_BOOK_UUID_INDEX,
        self::ADDRESS_UUID_PROP => self::ADDRESS_UUID_INDEX,
    ];

    protected const array META_TRANSFORMERS = [
        self::ADDRESS_BOOK_UUID_PROP => 'ADDRESS_BOOK_UUID_PROP',
        self::ADDRESS_UUID_PROP => 'ADDRESS_UUID_PROP',
    ];

    // addressBookUuid
    #[TransferTransformerAttribute(objectTransfer::class)]
    public const string ADDRESS_BOOK_UUID_PROP = 'addressBookUuid';
    private const int ADDRESS_BOOK_UUID_INDEX = 0;

    public ?objectTransfer $addressBookUuid {
        get => $this->getData(self::ADDRESS_BOOK_UUID_INDEX);
        set {
            $this->setData(self::ADDRESS_BOOK_UUID_INDEX, $value);
        }
    }

    // addressUuid
    #[TransferTransformerAttribute(stringTransfer::class)]
    public const string ADDRESS_UUID_PROP = 'addressUuid';
    private const int ADDRESS_UUID_INDEX = 1;

    public ?stringTransfer $addressUuid {
        get => $this->getData(self::ADDRESS_UUID_INDEX);
        set {
            $this->setData(self::ADDRESS_UUID_INDEX, $value);
        }
    }
}
