<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class CoordTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::LAT => self::LAT_DATA_NAME,
        self::LON => self::LON_DATA_NAME,
    ];

    // lat
    public const string LAT = 'lat';
    protected const string LAT_DATA_NAME = 'LAT';
    protected const int LAT_DATA_INDEX = 0;

    public ?float $lat {
        get => $this->_data[self::LAT_DATA_INDEX];
        set => $this->_data[self::LAT_DATA_INDEX] = $value;
    }

    // lon
    public const string LON = 'lon';
    protected const string LON_DATA_NAME = 'LON';
    protected const int LON_DATA_INDEX = 1;

    public ?float $lon {
        get => $this->_data[self::LON_DATA_INDEX];
        set => $this->_data[self::LON_DATA_INDEX] = $value;
    }
}
