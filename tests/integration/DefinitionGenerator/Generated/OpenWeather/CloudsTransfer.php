<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class CloudsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 1;

    protected const array META_DATA = [
        self::ALL => self::ALL_DATA_NAME,
    ];

    // all
    public const string ALL = 'all';
    protected const string ALL_DATA_NAME = 'ALL';
    protected const int ALL_DATA_INDEX = 0;

    public ?int $all {
        get => $this->_data[self::ALL_DATA_INDEX];
        set => $this->_data[self::ALL_DATA_INDEX] = $value;
    }
}
