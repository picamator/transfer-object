<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\DefinitionGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class BoxTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ITEMS => self::ITEMS_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
    ];

    // items
    public const string ITEMS = 'items';
    protected const string ITEMS_DATA_NAME = 'ITEMS';
    protected const int ITEMS_DATA_INDEX = 0;

    public ?int $items {
        get => $this->_data[self::ITEMS_DATA_INDEX];
        set => $this->_data[self::ITEMS_DATA_INDEX] = $value;
    }

    // type
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 1;

    public ?string $type {
        get => $this->_data[self::TYPE_DATA_INDEX];
        set => $this->_data[self::TYPE_DATA_INDEX] = $value;
    }
}
