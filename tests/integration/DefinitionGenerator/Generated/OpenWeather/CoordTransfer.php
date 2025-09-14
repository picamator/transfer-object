<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/open-weather/definition/forecast.transfer.yml Definition file path.
 */
final class CoordTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::LAT_INDEX => self::LAT,
        self::LON_INDEX => self::LON,
    ];

    // lat
    public const string LAT = 'lat';
    protected const int LAT_INDEX = 0;

    public ?float $lat {
        get => $this->getData(self::LAT_INDEX);
        set => $this->setData(self::LAT_INDEX, $value);
    }

    // lon
    public const string LON = 'lon';
    protected const int LON_INDEX = 1;

    public ?float $lon {
        get => $this->getData(self::LON_INDEX);
        set => $this->setData(self::LON_INDEX, $value);
    }
}
