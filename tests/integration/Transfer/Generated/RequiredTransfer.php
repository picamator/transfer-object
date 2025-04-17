<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class RequiredTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::I_AM_REQUIRED => self::I_AM_REQUIRED_DATA_NAME,
    ];

    // iAmRequired
    public const string I_AM_REQUIRED = 'iAmRequired';
    protected const string I_AM_REQUIRED_DATA_NAME = 'I_AM_REQUIRED';
    protected const int I_AM_REQUIRED_DATA_INDEX = 0;

    public string $iAmRequired {
        get => $this->getRequiredData(self::I_AM_REQUIRED_DATA_INDEX);
        set => $this->setData(self::I_AM_REQUIRED_DATA_INDEX, $value);
    }
}
