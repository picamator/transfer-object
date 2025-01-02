<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class CustomerTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::FIRST_NAME => self::FIRST_NAME_DATA_NAME,
        self::LAST_NAME => self::LAST_NAME_DATA_NAME,
    ];

    // firstName
    public const string FIRST_NAME = 'firstName';
    protected const string FIRST_NAME_DATA_NAME = 'FIRST_NAME';
    protected const int FIRST_NAME_DATA_INDEX = 0;

    public ?string $firstName {
        get => $this->getData(self::FIRST_NAME_DATA_INDEX);
        set => $this->setData(self::FIRST_NAME_DATA_INDEX, $value);
    }

    // lastName
    public const string LAST_NAME = 'lastName';
    protected const string LAST_NAME_DATA_NAME = 'LAST_NAME';
    protected const int LAST_NAME_DATA_INDEX = 1;

    public ?string $lastName {
        get => $this->getData(self::LAST_NAME_DATA_INDEX);
        set => $this->setData(self::LAST_NAME_DATA_INDEX, $value);
    }
}
