<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated\BcMath;

use BcMath\Number;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\NumberPropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/bcmath/definition/bcmath-number.transfer.yml Definition file path.
 */
final class BcMathNumberTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::I_AM_NUMBER => self::I_AM_NUMBER_DATA_NAME,
    ];

    // iAmNumber
    #[NumberPropertyTypeAttribute(Number::class)]
    public const string I_AM_NUMBER = 'iAmNumber';
    protected const string I_AM_NUMBER_DATA_NAME = 'I_AM_NUMBER';
    protected const int I_AM_NUMBER_DATA_INDEX = 0;

    public ?Number $iAmNumber {
        get => $this->getData(self::I_AM_NUMBER_DATA_INDEX);
        set => $this->setData(self::I_AM_NUMBER_DATA_INDEX, $value);
    }
}
