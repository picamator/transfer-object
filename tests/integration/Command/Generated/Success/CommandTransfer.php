<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command\Generated\Success;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class CommandTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::RUN => self::RUN_DATA_NAME,
    ];

    // run
    public const string RUN = 'run';
    protected const string RUN_DATA_NAME = 'RUN';
    protected const int RUN_DATA_INDEX = 0;

    public ?true $run {
        get => $this->getData(self::RUN_DATA_INDEX);
        set => $this->setData(self::RUN_DATA_INDEX, $value);
    }
}