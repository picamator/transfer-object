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
final class LabelsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::SALE_INDEX => self::SALE,
    ];

    // sale
    public const string SALE = 'sale';
    protected const int SALE_INDEX = 0;

    public ?string $sale {
        get => $this->getData(self::SALE_INDEX);
        set => $this->setData(self::SALE_INDEX, $value);
    }
}
