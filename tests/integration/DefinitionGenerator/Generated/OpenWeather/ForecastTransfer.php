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
        self::BASE_PROP => self::BASE_INDEX,
        self::CLOUDS_PROP => self::CLOUDS_INDEX,
        self::COD_PROP => self::COD_INDEX,
        self::COORD_PROP => self::COORD_INDEX,
        self::DT_PROP => self::DT_INDEX,
        self::ID_PROP => self::ID_INDEX,
        self::MAIN_PROP => self::MAIN_INDEX,
        self::NAME_PROP => self::NAME_INDEX,
        self::RAIN_PROP => self::RAIN_INDEX,
        self::SYS_PROP => self::SYS_INDEX,
        self::TIMEZONE_PROP => self::TIMEZONE_INDEX,
        self::VISIBILITY_PROP => self::VISIBILITY_INDEX,
        self::WEATHER_PROP => self::WEATHER_INDEX,
        self::WIND_PROP => self::WIND_INDEX,
    ];

    // base
    public const string BASE_PROP = 'base';
    private const int BASE_INDEX = 0;

    public ?string $base {
        get => $this->getData(self::BASE_INDEX);
        set => $this->setData(self::BASE_INDEX, $value);
    }

    // clouds
    #[TransferTransformerAttribute(CloudsTransfer::class)]
    public const string CLOUDS_PROP = 'clouds';
    private const int CLOUDS_INDEX = 1;

    public ?CloudsTransfer $clouds {
        get => $this->getData(self::CLOUDS_INDEX);
        set => $this->setData(self::CLOUDS_INDEX, $value);
    }

    // cod
    public const string COD_PROP = 'cod';
    private const int COD_INDEX = 2;

    public ?int $cod {
        get => $this->getData(self::COD_INDEX);
        set => $this->setData(self::COD_INDEX, $value);
    }

    // coord
    #[TransferTransformerAttribute(CoordTransfer::class)]
    public const string COORD_PROP = 'coord';
    private const int COORD_INDEX = 3;

    public ?CoordTransfer $coord {
        get => $this->getData(self::COORD_INDEX);
        set => $this->setData(self::COORD_INDEX, $value);
    }

    // dt
    public const string DT_PROP = 'dt';
    private const int DT_INDEX = 4;

    public ?int $dt {
        get => $this->getData(self::DT_INDEX);
        set => $this->setData(self::DT_INDEX, $value);
    }

    // id
    public const string ID_PROP = 'id';
    private const int ID_INDEX = 5;

    public ?int $id {
        get => $this->getData(self::ID_INDEX);
        set => $this->setData(self::ID_INDEX, $value);
    }

    // main
    #[TransferTransformerAttribute(MainTransfer::class)]
    public const string MAIN_PROP = 'main';
    private const int MAIN_INDEX = 6;

    public ?MainTransfer $main {
        get => $this->getData(self::MAIN_INDEX);
        set => $this->setData(self::MAIN_INDEX, $value);
    }

    // name
    public const string NAME_PROP = 'name';
    private const int NAME_INDEX = 7;

    public ?string $name {
        get => $this->getData(self::NAME_INDEX);
        set => $this->setData(self::NAME_INDEX, $value);
    }

    // rain
    #[ArrayInitiatorAttribute]
    public const string RAIN_PROP = 'rain';
    private const int RAIN_INDEX = 8;

    /** @var array<int|string,mixed> */
    public array $rain {
        get => $this->getData(self::RAIN_INDEX);
        set => $this->setData(self::RAIN_INDEX, $value);
    }

    // sys
    #[TransferTransformerAttribute(SysTransfer::class)]
    public const string SYS_PROP = 'sys';
    private const int SYS_INDEX = 9;

    public ?SysTransfer $sys {
        get => $this->getData(self::SYS_INDEX);
        set => $this->setData(self::SYS_INDEX, $value);
    }

    // timezone
    public const string TIMEZONE_PROP = 'timezone';
    private const int TIMEZONE_INDEX = 10;

    public ?int $timezone {
        get => $this->getData(self::TIMEZONE_INDEX);
        set => $this->setData(self::TIMEZONE_INDEX, $value);
    }

    // visibility
    public const string VISIBILITY_PROP = 'visibility';
    private const int VISIBILITY_INDEX = 11;

    public ?int $visibility {
        get => $this->getData(self::VISIBILITY_INDEX);
        set => $this->setData(self::VISIBILITY_INDEX, $value);
    }

    // weather
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(WeatherTransfer::class)]
    public const string WEATHER_PROP = 'weather';
    private const int WEATHER_INDEX = 12;

    /** @var \ArrayObject<int,WeatherTransfer> */
    public ArrayObject $weather {
        get => $this->getData(self::WEATHER_INDEX);
        set => $this->setData(self::WEATHER_INDEX, $value);
    }

    // wind
    #[TransferTransformerAttribute(WindTransfer::class)]
    public const string WIND_PROP = 'wind';
    private const int WIND_INDEX = 13;

    public ?WindTransfer $wind {
        get => $this->getData(self::WIND_INDEX);
        set => $this->setData(self::WIND_INDEX, $value);
    }
}
