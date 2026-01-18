<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use Picamator\Tests\Integration\TransferObject\Transfer\Advanced\ReservedPropertyData;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/reserved-advanced.transfer.yml Definition file path.
 */
final class ReservedAdvancedTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::DATA_PROP => self::DATA_INDEX,
    ];

    // data
    #[TransferTransformerAttribute(ReservedPropertyData::class)]
    public const string DATA_PROP = 'data';
    private const int DATA_INDEX = 0;

    public TransferInterface&ReservedPropertyData $data {
        get => $this->getData(self::DATA_INDEX);
        set {
            $this->setData(self::DATA_INDEX, $value);
        }
    }
}
