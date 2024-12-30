<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\TransferGenerator\Generated\Success;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class CountryTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ISO2_CODE => self::ISO2_CODE_DATA_NAME,
        self::NAME => self::NAME_DATA_NAME,
    ];

    // iso2Code
    public const string ISO2_CODE = 'iso2Code';
    protected const string ISO2_CODE_DATA_NAME = 'ISO2_CODE';
    protected const int ISO2_CODE_DATA_INDEX = 0;

    public ?string $iso2Code {
        get => $this->_data[self::ISO2_CODE_DATA_INDEX];
        set => $this->_data[self::ISO2_CODE_DATA_INDEX] = $value;
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 1;

    public ?string $name {
        get => $this->_data[self::NAME_DATA_INDEX];
        set => $this->_data[self::NAME_DATA_INDEX] = $value;
    }
}
