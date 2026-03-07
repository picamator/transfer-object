<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Error;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/TransferGenerator/data/config/error/missed-type/definition/address-statistics.transfer.yml Definition file path.
 */
final class AddressStatisticsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::ADDRESS_BOOK_UUID_PROP => self::ADDRESS_BOOK_UUID_INDEX,
    ];

    // addressBookUuid
    public const string ADDRESS_BOOK_UUID_PROP = 'addressBookUuid';
    private const int ADDRESS_BOOK_UUID_INDEX = 0;

    public ?string $addressBookUuid {
        get => $this->getData(self::ADDRESS_BOOK_UUID_INDEX);
        set {
            $this->setData(self::ADDRESS_BOOK_UUID_INDEX, $value);
        }
    }
}
