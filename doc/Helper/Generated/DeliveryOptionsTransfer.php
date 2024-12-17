<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Helper\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class DeliveryOptionsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::NAME => self::NAME_DATA_NAME,
    ];

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 0;

    public ?string $name {
        get => $this->_data[self::NAME_DATA_INDEX];
        set => $this->_data[self::NAME_DATA_INDEX] = $value;
    }
}
