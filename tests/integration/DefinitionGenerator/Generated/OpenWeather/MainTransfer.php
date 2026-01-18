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
final class MainTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 8;

    protected const array META_DATA = [
        self::FEELS_LIKE_PROP => self::FEELS_LIKE_INDEX,
        self::GRND_LEVEL_PROP => self::GRND_LEVEL_INDEX,
        self::HUMIDITY_PROP => self::HUMIDITY_INDEX,
        self::PRESSURE_PROP => self::PRESSURE_INDEX,
        self::SEA_LEVEL_PROP => self::SEA_LEVEL_INDEX,
        self::TEMP_PROP => self::TEMP_INDEX,
        self::TEMP_MAX_PROP => self::TEMP_MAX_INDEX,
        self::TEMP_MIN_PROP => self::TEMP_MIN_INDEX,
    ];

    // feels_like
    public const string FEELS_LIKE_PROP = 'feels_like';
    private const int FEELS_LIKE_INDEX = 0;

    public ?float $feels_like {
        get => $this->getData(self::FEELS_LIKE_INDEX);
        set {
            $this->setData(self::FEELS_LIKE_INDEX, $value);
        }
    }

    // grnd_level
    public const string GRND_LEVEL_PROP = 'grnd_level';
    private const int GRND_LEVEL_INDEX = 1;

    public ?int $grnd_level {
        get => $this->getData(self::GRND_LEVEL_INDEX);
        set {
            $this->setData(self::GRND_LEVEL_INDEX, $value);
        }
    }

    // humidity
    public const string HUMIDITY_PROP = 'humidity';
    private const int HUMIDITY_INDEX = 2;

    public ?int $humidity {
        get => $this->getData(self::HUMIDITY_INDEX);
        set {
            $this->setData(self::HUMIDITY_INDEX, $value);
        }
    }

    // pressure
    public const string PRESSURE_PROP = 'pressure';
    private const int PRESSURE_INDEX = 3;

    public ?int $pressure {
        get => $this->getData(self::PRESSURE_INDEX);
        set {
            $this->setData(self::PRESSURE_INDEX, $value);
        }
    }

    // sea_level
    public const string SEA_LEVEL_PROP = 'sea_level';
    private const int SEA_LEVEL_INDEX = 4;

    public ?int $sea_level {
        get => $this->getData(self::SEA_LEVEL_INDEX);
        set {
            $this->setData(self::SEA_LEVEL_INDEX, $value);
        }
    }

    // temp
    public const string TEMP_PROP = 'temp';
    private const int TEMP_INDEX = 5;

    public ?float $temp {
        get => $this->getData(self::TEMP_INDEX);
        set {
            $this->setData(self::TEMP_INDEX, $value);
        }
    }

    // temp_max
    public const string TEMP_MAX_PROP = 'temp_max';
    private const int TEMP_MAX_INDEX = 6;

    public ?float $temp_max {
        get => $this->getData(self::TEMP_MAX_INDEX);
        set {
            $this->setData(self::TEMP_MAX_INDEX, $value);
        }
    }

    // temp_min
    public const string TEMP_MIN_PROP = 'temp_min';
    private const int TEMP_MIN_INDEX = 7;

    public ?float $temp_min {
        get => $this->getData(self::TEMP_MIN_INDEX);
        set {
            $this->setData(self::TEMP_MIN_INDEX, $value);
        }
    }
}
