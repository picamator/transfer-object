<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Command\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
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
        get => $this->_data[self::RUN_DATA_INDEX];
        set => $this->_data[self::RUN_DATA_INDEX] = $value;
    }
}
