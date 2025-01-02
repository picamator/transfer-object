<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
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
final class ForecastTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 14;

    protected const array META_DATA = [
        self::BASE => self::BASE_DATA_NAME,
        self::CLOUDS => self::CLOUDS_DATA_NAME,
        self::COD => self::COD_DATA_NAME,
        self::COORD => self::COORD_DATA_NAME,
        self::DT => self::DT_DATA_NAME,
        self::ID => self::ID_DATA_NAME,
        self::MAIN => self::MAIN_DATA_NAME,
        self::NAME => self::NAME_DATA_NAME,
        self::RAIN => self::RAIN_DATA_NAME,
        self::SYS => self::SYS_DATA_NAME,
        self::TIMEZONE => self::TIMEZONE_DATA_NAME,
        self::VISIBILITY => self::VISIBILITY_DATA_NAME,
        self::WEATHER => self::WEATHER_DATA_NAME,
        self::WIND => self::WIND_DATA_NAME,
    ];

    // base
    public const string BASE = 'base';
    protected const string BASE_DATA_NAME = 'BASE';
    protected const int BASE_DATA_INDEX = 0;

    public ?string $base {
        get => $this->getData(self::BASE_DATA_INDEX);
        set => $this->setData(self::BASE_DATA_INDEX, $value);
    }

    // clouds
    #[PropertyTypeAttribute(CloudsTransfer::class)]
    public const string CLOUDS = 'clouds';
    protected const string CLOUDS_DATA_NAME = 'CLOUDS';
    protected const int CLOUDS_DATA_INDEX = 1;

    public ?CloudsTransfer $clouds {
        get => $this->getData(self::CLOUDS_DATA_INDEX);
        set => $this->setData(self::CLOUDS_DATA_INDEX, $value);
    }

    // cod
    public const string COD = 'cod';
    protected const string COD_DATA_NAME = 'COD';
    protected const int COD_DATA_INDEX = 2;

    public ?int $cod {
        get => $this->getData(self::COD_DATA_INDEX);
        set => $this->setData(self::COD_DATA_INDEX, $value);
    }

    // coord
    #[PropertyTypeAttribute(CoordTransfer::class)]
    public const string COORD = 'coord';
    protected const string COORD_DATA_NAME = 'COORD';
    protected const int COORD_DATA_INDEX = 3;

    public ?CoordTransfer $coord {
        get => $this->getData(self::COORD_DATA_INDEX);
        set => $this->setData(self::COORD_DATA_INDEX, $value);
    }

    // dt
    public const string DT = 'dt';
    protected const string DT_DATA_NAME = 'DT';
    protected const int DT_DATA_INDEX = 4;

    public ?int $dt {
        get => $this->getData(self::DT_DATA_INDEX);
        set => $this->setData(self::DT_DATA_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    protected const string ID_DATA_NAME = 'ID';
    protected const int ID_DATA_INDEX = 5;

    public ?int $id {
        get => $this->getData(self::ID_DATA_INDEX);
        set => $this->setData(self::ID_DATA_INDEX, $value);
    }

    // main
    #[PropertyTypeAttribute(MainTransfer::class)]
    public const string MAIN = 'main';
    protected const string MAIN_DATA_NAME = 'MAIN';
    protected const int MAIN_DATA_INDEX = 6;

    public ?MainTransfer $main {
        get => $this->getData(self::MAIN_DATA_INDEX);
        set => $this->setData(self::MAIN_DATA_INDEX, $value);
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 7;

    public ?string $name {
        get => $this->getData(self::NAME_DATA_INDEX);
        set => $this->setData(self::NAME_DATA_INDEX, $value);
    }

    // rain
    #[ArrayPropertyTypeAttribute]
    public const string RAIN = 'rain';
    protected const string RAIN_DATA_NAME = 'RAIN';
    protected const int RAIN_DATA_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $rain {
        get => $this->getData(self::RAIN_DATA_INDEX);
        set => $this->setData(self::RAIN_DATA_INDEX, $value);
    }

    // sys
    #[PropertyTypeAttribute(SysTransfer::class)]
    public const string SYS = 'sys';
    protected const string SYS_DATA_NAME = 'SYS';
    protected const int SYS_DATA_INDEX = 9;

    public ?SysTransfer $sys {
        get => $this->getData(self::SYS_DATA_INDEX);
        set => $this->setData(self::SYS_DATA_INDEX, $value);
    }

    // timezone
    public const string TIMEZONE = 'timezone';
    protected const string TIMEZONE_DATA_NAME = 'TIMEZONE';
    protected const int TIMEZONE_DATA_INDEX = 10;

    public ?int $timezone {
        get => $this->getData(self::TIMEZONE_DATA_INDEX);
        set => $this->setData(self::TIMEZONE_DATA_INDEX, $value);
    }

    // visibility
    public const string VISIBILITY = 'visibility';
    protected const string VISIBILITY_DATA_NAME = 'VISIBILITY';
    protected const int VISIBILITY_DATA_INDEX = 11;

    public ?int $visibility {
        get => $this->getData(self::VISIBILITY_DATA_INDEX);
        set => $this->setData(self::VISIBILITY_DATA_INDEX, $value);
    }

    // weather
    #[CollectionPropertyTypeAttribute(WeatherTransfer::class)]
    public const string WEATHER = 'weather';
    protected const string WEATHER_DATA_NAME = 'WEATHER';
    protected const int WEATHER_DATA_INDEX = 12;

    /** @var \ArrayObject<int,WeatherTransfer> */
    public ArrayObject $weather {
        get => $this->getData(self::WEATHER_DATA_INDEX);
        set => $this->setData(self::WEATHER_DATA_INDEX, $value);
    }

    // wind
    #[PropertyTypeAttribute(WindTransfer::class)]
    public const string WIND = 'wind';
    protected const string WIND_DATA_NAME = 'WIND';
    protected const int WIND_DATA_INDEX = 13;

    public ?WindTransfer $wind {
        get => $this->getData(self::WIND_DATA_INDEX);
        set => $this->setData(self::WIND_DATA_INDEX, $value);
    }
}
