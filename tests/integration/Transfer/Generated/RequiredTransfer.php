<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/required.transfer.yml Definition file path.
 */
final class RequiredTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::I_AM_REQUIRED => self::I_AM_REQUIRED_DATA_NAME,
    ];

    // iAmRequired
    public const string I_AM_REQUIRED = 'iAmRequired';
    protected const string I_AM_REQUIRED_DATA_NAME = 'I_AM_REQUIRED';
    protected const int I_AM_REQUIRED_DATA_INDEX = 0;

    public string $iAmRequired {
        get => $this->_data[self::I_AM_REQUIRED_DATA_INDEX];
        set => $this->_data[self::I_AM_REQUIRED_DATA_INDEX] = $value;
    }
}
