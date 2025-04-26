<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /doc/samples/config/definition-generator/definition/product.transfer.yml Definition file path.
 */
final class LabelsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::SALE => self::SALE_DATA_NAME,
    ];

    // sale
    public const string SALE = 'sale';
    protected const string SALE_DATA_NAME = 'SALE';
    protected const int SALE_DATA_INDEX = 0;

    public ?string $sale {
        get => $this->_data[self::SALE_DATA_INDEX];
        set => $this->_data[self::SALE_DATA_INDEX] = $value;
    }
}
