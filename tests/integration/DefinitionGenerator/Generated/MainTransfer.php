<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class MainTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 8;

    protected const array META_DATA = [
        self::FEELS_LIKE => self::FEELS_LIKE_DATA_NAME,
        self::GRND_LEVEL => self::GRND_LEVEL_DATA_NAME,
        self::HUMIDITY => self::HUMIDITY_DATA_NAME,
        self::PRESSURE => self::PRESSURE_DATA_NAME,
        self::SEA_LEVEL => self::SEA_LEVEL_DATA_NAME,
        self::TEMP => self::TEMP_DATA_NAME,
        self::TEMP_MAX => self::TEMP_MAX_DATA_NAME,
        self::TEMP_MIN => self::TEMP_MIN_DATA_NAME,
    ];

    // feels_like
    public const string FEELS_LIKE = 'feels_like';
    protected const string FEELS_LIKE_DATA_NAME = 'FEELS_LIKE';
    protected const int FEELS_LIKE_DATA_INDEX = 0;

    public ?float $feels_like {
        get => $this->_data[self::FEELS_LIKE_DATA_INDEX];
        set => $this->_data[self::FEELS_LIKE_DATA_INDEX] = $value;
    }

    // grnd_level
    public const string GRND_LEVEL = 'grnd_level';
    protected const string GRND_LEVEL_DATA_NAME = 'GRND_LEVEL';
    protected const int GRND_LEVEL_DATA_INDEX = 1;

    public ?int $grnd_level {
        get => $this->_data[self::GRND_LEVEL_DATA_INDEX];
        set => $this->_data[self::GRND_LEVEL_DATA_INDEX] = $value;
    }

    // humidity
    public const string HUMIDITY = 'humidity';
    protected const string HUMIDITY_DATA_NAME = 'HUMIDITY';
    protected const int HUMIDITY_DATA_INDEX = 2;

    public ?int $humidity {
        get => $this->_data[self::HUMIDITY_DATA_INDEX];
        set => $this->_data[self::HUMIDITY_DATA_INDEX] = $value;
    }

    // pressure
    public const string PRESSURE = 'pressure';
    protected const string PRESSURE_DATA_NAME = 'PRESSURE';
    protected const int PRESSURE_DATA_INDEX = 3;

    public ?int $pressure {
        get => $this->_data[self::PRESSURE_DATA_INDEX];
        set => $this->_data[self::PRESSURE_DATA_INDEX] = $value;
    }

    // sea_level
    public const string SEA_LEVEL = 'sea_level';
    protected const string SEA_LEVEL_DATA_NAME = 'SEA_LEVEL';
    protected const int SEA_LEVEL_DATA_INDEX = 4;

    public ?int $sea_level {
        get => $this->_data[self::SEA_LEVEL_DATA_INDEX];
        set => $this->_data[self::SEA_LEVEL_DATA_INDEX] = $value;
    }

    // temp
    public const string TEMP = 'temp';
    protected const string TEMP_DATA_NAME = 'TEMP';
    protected const int TEMP_DATA_INDEX = 5;

    public ?float $temp {
        get => $this->_data[self::TEMP_DATA_INDEX];
        set => $this->_data[self::TEMP_DATA_INDEX] = $value;
    }

    // temp_max
    public const string TEMP_MAX = 'temp_max';
    protected const string TEMP_MAX_DATA_NAME = 'TEMP_MAX';
    protected const int TEMP_MAX_DATA_INDEX = 6;

    public ?float $temp_max {
        get => $this->_data[self::TEMP_MAX_DATA_INDEX];
        set => $this->_data[self::TEMP_MAX_DATA_INDEX] = $value;
    }

    // temp_min
    public const string TEMP_MIN = 'temp_min';
    protected const string TEMP_MIN_DATA_NAME = 'TEMP_MIN';
    protected const int TEMP_MIN_DATA_INDEX = 7;

    public ?float $temp_min {
        get => $this->_data[self::TEMP_MIN_DATA_INDEX];
        set => $this->_data[self::TEMP_MIN_DATA_INDEX] = $value;
    }
}