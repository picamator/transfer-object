<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class AvailabilitiesTransfer extends AbstractTransfer
{
    use TransferTrait;

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
        get => $this->getData(self::BUFFER_DATA_INDEX);
        set => $this->setData(self::BUFFER_DATA_INDEX, $value);
    }

    // total
    public const string TOTAL = 'total';
    protected const string TOTAL_DATA_NAME = 'TOTAL';
    protected const int TOTAL_DATA_INDEX = 1;

    public ?int $total {
        get => $this->getData(self::TOTAL_DATA_INDEX);
        set => $this->setData(self::TOTAL_DATA_INDEX, $value);
    }
}
