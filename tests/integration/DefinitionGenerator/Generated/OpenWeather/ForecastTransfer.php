<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\ArrayPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/open-weather/definition/forecast.transfer.yml Definition file path.
 */
final class ForecastTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 14;

    protected const array META_DATA = [
        self::BASE_INDEX => self::BASE,
        self::CLOUDS_INDEX => self::CLOUDS,
        self::COD_INDEX => self::COD,
        self::COORD_INDEX => self::COORD,
        self::DT_INDEX => self::DT,
        self::ID_INDEX => self::ID,
        self::MAIN_INDEX => self::MAIN,
        self::NAME_INDEX => self::NAME,
        self::RAIN_INDEX => self::RAIN,
        self::SYS_INDEX => self::SYS,
        self::TIMEZONE_INDEX => self::TIMEZONE,
        self::VISIBILITY_INDEX => self::VISIBILITY,
        self::WEATHER_INDEX => self::WEATHER,
        self::WIND_INDEX => self::WIND,
    ];

    // base
    public const string BASE = 'base';
    private const int BASE_INDEX = 0;

    public ?string $base {
        get => $this->getData(self::BASE_INDEX);
        set => $this->setData(self::BASE_INDEX, $value);
    }

    // clouds
    #[PropertyTypeAttribute(CloudsTransfer::class)]
    public const string CLOUDS = 'clouds';
    private const int CLOUDS_INDEX = 1;

    public ?CloudsTransfer $clouds {
        get => $this->getData(self::CLOUDS_INDEX);
        set => $this->setData(self::CLOUDS_INDEX, $value);
    }

    // cod
    public const string COD = 'cod';
    private const int COD_INDEX = 2;

    public ?int $cod {
        get => $this->getData(self::COD_INDEX);
        set => $this->setData(self::COD_INDEX, $value);
    }

    // coord
    #[PropertyTypeAttribute(CoordTransfer::class)]
    public const string COORD = 'coord';
    private const int COORD_INDEX = 3;

    public ?CoordTransfer $coord {
        get => $this->getData(self::COORD_INDEX);
        set => $this->setData(self::COORD_INDEX, $value);
    }

    // dt
    public const string DT = 'dt';
    private const int DT_INDEX = 4;

    public ?int $dt {
        get => $this->getData(self::DT_INDEX);
        set => $this->setData(self::DT_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    private const int ID_INDEX = 5;

    public ?int $id {
        get => $this->getData(self::ID_INDEX);
        set => $this->setData(self::ID_INDEX, $value);
    }

    // main
    #[PropertyTypeAttribute(MainTransfer::class)]
    public const string MAIN = 'main';
    private const int MAIN_INDEX = 6;

    public ?MainTransfer $main {
        get => $this->getData(self::MAIN_INDEX);
        set => $this->setData(self::MAIN_INDEX, $value);
    }

    // name
    public const string NAME = 'name';
    private const int NAME_INDEX = 7;

    public ?string $name {
        get => $this->getData(self::NAME_INDEX);
        set => $this->setData(self::NAME_INDEX, $value);
    }

    // rain
    #[ArrayPropertyTypeAttribute]
    public const string RAIN = 'rain';
    private const int RAIN_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $rain {
        get => $this->getData(self::RAIN_INDEX);
        set => $this->setData(self::RAIN_INDEX, $value);
    }

    // sys
    #[PropertyTypeAttribute(SysTransfer::class)]
    public const string SYS = 'sys';
    private const int SYS_INDEX = 9;

    public ?SysTransfer $sys {
        get => $this->getData(self::SYS_INDEX);
        set => $this->setData(self::SYS_INDEX, $value);
    }

    // timezone
    public const string TIMEZONE = 'timezone';
    private const int TIMEZONE_INDEX = 10;

    public ?int $timezone {
        get => $this->getData(self::TIMEZONE_INDEX);
        set => $this->setData(self::TIMEZONE_INDEX, $value);
    }

    // visibility
    public const string VISIBILITY = 'visibility';
    private const int VISIBILITY_INDEX = 11;

    public ?int $visibility {
        get => $this->getData(self::VISIBILITY_INDEX);
        set => $this->setData(self::VISIBILITY_INDEX, $value);
    }

    // weather
    #[CollectionPropertyTypeAttribute(WeatherTransfer::class)]
    public const string WEATHER = 'weather';
    private const int WEATHER_INDEX = 12;

    /** @var \ArrayObject<int,WeatherTransfer> */
    public ArrayObject $weather {
        get => $this->getData(self::WEATHER_INDEX);
        set => $this->setData(self::WEATHER_INDEX, $value);
    }

    // wind
    #[PropertyTypeAttribute(WindTransfer::class)]
    public const string WIND = 'wind';
    private const int WIND_INDEX = 13;

    public ?WindTransfer $wind {
        get => $this->getData(self::WIND_INDEX);
        set => $this->setData(self::WIND_INDEX, $value);
    }
}
