<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/definition-generator/definition/product.transfer.yml Definition file path.
 */
final class AvailabilitiesTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::BUFFER_INDEX => self::BUFFER,
        self::TOTAL_INDEX => self::TOTAL,
    ];

    // buffer
    public const string BUFFER = 'buffer';
    protected const int BUFFER_INDEX = 0;

    public ?int $buffer {
        get => $this->getData(self::BUFFER_INDEX);
        set => $this->setData(self::BUFFER_INDEX, $value);
    }

    // total
    public const string TOTAL = 'total';
    protected const int TOTAL_INDEX = 1;

    public ?int $total {
        get => $this->getData(self::TOTAL_INDEX);
        set => $this->setData(self::TOTAL_INDEX, $value);
    }
}
