<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class CoordTransfer extends AbstractTransfer
{
    use TransferTrait;

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
        get => $this->getData(self::LAT_DATA_INDEX);
        set => $this->setData(self::LAT_DATA_INDEX, $value);
    }

    // lon
    public const string LON = 'lon';
    protected const string LON_DATA_NAME = 'LON';
    protected const int LON_DATA_INDEX = 1;

    public ?float $lon {
        get => $this->getData(self::LON_DATA_INDEX);
        set => $this->setData(self::LON_DATA_INDEX, $value);
    }
}
