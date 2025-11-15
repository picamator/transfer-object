<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Initiator\CollectionInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

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
        self::BASE => self::BASE_INDEX,
        self::CLOUDS => self::CLOUDS_INDEX,
        self::COD => self::COD_INDEX,
        self::COORD => self::COORD_INDEX,
        self::DT => self::DT_INDEX,
        self::ID => self::ID_INDEX,
        self::MAIN => self::MAIN_INDEX,
        self::NAME => self::NAME_INDEX,
        self::RAIN => self::RAIN_INDEX,
        self::SYS => self::SYS_INDEX,
        self::TIMEZONE => self::TIMEZONE_INDEX,
        self::VISIBILITY => self::VISIBILITY_INDEX,
        self::WEATHER => self::WEATHER_INDEX,
        self::WIND => self::WIND_INDEX,
    ];

    // base
    public const string BASE = 'base';
    private const int BASE_INDEX = 0;

    public ?string $base {
        get => $this->getData(self::BASE_INDEX);
        set => $this->setData(self::BASE_INDEX, $value);
    }

    // clouds
    #[TransferTransformerAttribute(CloudsTransfer::class)]
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
    #[TransferTransformerAttribute(CoordTransfer::class)]
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
    #[TransferTransformerAttribute(MainTransfer::class)]
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
    #[ArrayInitiatorAttribute]
    public const string RAIN = 'rain';
    private const int RAIN_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $rain {
        get => $this->getData(self::RAIN_INDEX);
        set => $this->setData(self::RAIN_INDEX, $value);
    }

    // sys
    #[TransferTransformerAttribute(SysTransfer::class)]
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
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(WeatherTransfer::class)]
    public const string WEATHER = 'weather';
    private const int WEATHER_INDEX = 12;

    /** @var \ArrayObject<int,WeatherTransfer> */
    public ArrayObject $weather {
        get => $this->getData(self::WEATHER_INDEX);
        set => $this->setData(self::WEATHER_INDEX, $value);
    }

    // wind
    #[TransferTransformerAttribute(WindTransfer::class)]
    public const string WIND = 'wind';
    private const int WIND_INDEX = 13;

    public ?WindTransfer $wind {
        get => $this->getData(self::WIND_INDEX);
        set => $this->setData(self::WIND_INDEX, $value);
    }
}
