<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Samples\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class CustomerTransfer extends AbstractTransfer
{
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
        get => $this->data[self::FIRST_NAME_DATA_INDEX];
        set => $this->data[self::FIRST_NAME_DATA_INDEX] = $value;
    }

    // lastName
    public const string LAST_NAME = 'lastName';
    protected const string LAST_NAME_DATA_NAME = 'LAST_NAME';
    protected const int LAST_NAME_DATA_INDEX = 1;
    
    public ?bool $lastName {
        get => $this->data[self::LAST_NAME_DATA_INDEX];
        set => $this->data[self::LAST_NAME_DATA_INDEX] = $value;
    }
}
