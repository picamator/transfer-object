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
 * @see /tests/integration/Transfer/data/config/definition/protected.transfer.yml Definition file path.
 */
final class ProtectedTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::I_AM_PROTECTED_INDEX => self::I_AM_PROTECTED,
    ];

    // iAmProtected
    public const string I_AM_PROTECTED = 'iAmProtected';
    protected const int I_AM_PROTECTED_INDEX = 0;

    public protected(set) ?string $iAmProtected {
        get => $this->getData(self::I_AM_PROTECTED_INDEX);
        set => $this->setData(self::I_AM_PROTECTED_INDEX, $value);
    }
}
