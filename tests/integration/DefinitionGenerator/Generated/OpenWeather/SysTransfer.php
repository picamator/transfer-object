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
 */
final class SysTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::COUNTRY => self::COUNTRY_DATA_NAME,
        self::ID => self::ID_DATA_NAME,
        self::SUNRISE => self::SUNRISE_DATA_NAME,
        self::SUNSET => self::SUNSET_DATA_NAME,
        self::TYPE => self::TYPE_DATA_NAME,
    ];

    // country
    public const string COUNTRY = 'country';
    protected const string COUNTRY_DATA_NAME = 'COUNTRY';
    protected const int COUNTRY_DATA_INDEX = 0;

    public ?string $country {
        get => $this->_data[self::COUNTRY_DATA_INDEX];
        set => $this->_data[self::COUNTRY_DATA_INDEX] = $value;
    }

    // id
    public const string ID = 'id';
    protected const string ID_DATA_NAME = 'ID';
    protected const int ID_DATA_INDEX = 1;

    public ?int $id {
        get => $this->_data[self::ID_DATA_INDEX];
        set => $this->_data[self::ID_DATA_INDEX] = $value;
    }

    // sunrise
    public const string SUNRISE = 'sunrise';
    protected const string SUNRISE_DATA_NAME = 'SUNRISE';
    protected const int SUNRISE_DATA_INDEX = 2;

    public ?int $sunrise {
        get => $this->_data[self::SUNRISE_DATA_INDEX];
        set => $this->_data[self::SUNRISE_DATA_INDEX] = $value;
    }

    // sunset
    public const string SUNSET = 'sunset';
    protected const string SUNSET_DATA_NAME = 'SUNSET';
    protected const int SUNSET_DATA_INDEX = 3;

    public ?int $sunset {
        get => $this->_data[self::SUNSET_DATA_INDEX];
        set => $this->_data[self::SUNSET_DATA_INDEX] = $value;
    }

    // type
    public const string TYPE = 'type';
    protected const string TYPE_DATA_NAME = 'TYPE';
    protected const int TYPE_DATA_INDEX = 4;

    public ?int $type {
        get => $this->_data[self::TYPE_DATA_INDEX];
        set => $this->_data[self::TYPE_DATA_INDEX] = $value;
    }
}
