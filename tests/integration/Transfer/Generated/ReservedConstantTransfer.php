<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/Transfer/data/config/definition/reserved-constant.transfer.yml Definition file path.
 */
final class ReservedConstantTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::FILTER_DATA_CALLBACK_PROP => self::FILTER_DATA_CALLBACK_INDEX,
        self::META_DATA_PROP => self::META_DATA_INDEX,
        self::META_DATA_SIZE_PROP => self::META_DATA_SIZE_INDEX,
    ];

    // filter_data_callback
    public const string FILTER_DATA_CALLBACK_PROP = 'filter_data_callback';
    private const int FILTER_DATA_CALLBACK_INDEX = 0;

    public ?string $filter_data_callback {
        get => $this->getData(self::FILTER_DATA_CALLBACK_INDEX);
        set => $this->setData(self::FILTER_DATA_CALLBACK_INDEX, $value);
    }

    // meta_data
    public const string META_DATA_PROP = 'meta_data';
    private const int META_DATA_INDEX = 1;

    public ?string $meta_data {
        get => $this->getData(self::META_DATA_INDEX);
        set => $this->setData(self::META_DATA_INDEX, $value);
    }

    // meta_data_size
    public const string META_DATA_SIZE_PROP = 'meta_data_size';
    private const int META_DATA_SIZE_INDEX = 2;

    public ?string $meta_data_size {
        get => $this->getData(self::META_DATA_SIZE_INDEX);
        set => $this->setData(self::META_DATA_SIZE_INDEX, $value);
    }
}
