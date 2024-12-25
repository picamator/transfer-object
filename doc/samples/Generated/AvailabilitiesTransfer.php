<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class AvailabilitiesTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::BUFFER => self::BUFFER_DATA_NAME,
        self::TOTAL => self::TOTAL_DATA_NAME,
    ];

    // buffer
    public const string BUFFER = 'buffer';
    protected const string BUFFER_DATA_NAME = 'BUFFER';
    protected const int BUFFER_DATA_INDEX = 0;

    public ?int $buffer {
        get => $this->_data[self::BUFFER_DATA_INDEX];
        set => $this->_data[self::BUFFER_DATA_INDEX] = $value;
    }

    // total
    public const string TOTAL = 'total';
    protected const string TOTAL_DATA_NAME = 'TOTAL';
    protected const int TOTAL_DATA_INDEX = 1;

    public ?int $total {
        get => $this->_data[self::TOTAL_DATA_INDEX];
        set => $this->_data[self::TOTAL_DATA_INDEX] = $value;
    }
}
