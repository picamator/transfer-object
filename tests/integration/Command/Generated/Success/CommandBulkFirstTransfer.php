<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command\Generated\Success;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Command/data/config/success/definition-bulk-first/command.first.transfer.yml Definition file path.
 */
final class CommandBulkFirstTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::RUN_PROP => self::RUN_INDEX,
    ];

    // run
    public const string RUN_PROP = 'run';
    private const int RUN_INDEX = 0;

    public ?true $run {
        get => $this->getData(self::RUN_INDEX);
        set {
            $this->setData(self::RUN_INDEX, $value);
        }
    }
}
