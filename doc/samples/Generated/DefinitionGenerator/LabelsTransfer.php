<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update corresponding definition file and run generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class LabelsTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::SALE => self::SALE_DATA_NAME,
    ];

    // sale
    public const string SALE = 'sale';
    protected const string SALE_DATA_NAME = 'SALE';
    protected const int SALE_DATA_INDEX = 0;

    public ?string $sale {
        get => $this->getData(self::SALE_DATA_INDEX);
        set => $this->setData(self::SALE_DATA_INDEX, $value);
    }
}
