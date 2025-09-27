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
final class SysTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 5;

    protected const array META_DATA = [
        self::COUNTRY_INDEX => self::COUNTRY,
        self::ID_INDEX => self::ID,
        self::SUNRISE_INDEX => self::SUNRISE,
        self::SUNSET_INDEX => self::SUNSET,
        self::TYPE_INDEX => self::TYPE,
    ];

    // country
    public const string COUNTRY = 'country';
    private const int COUNTRY_INDEX = 0;

    public ?string $country {
        get => $this->getData(self::COUNTRY_INDEX);
        set => $this->setData(self::COUNTRY_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    private const int ID_INDEX = 1;

    public ?int $id {
        get => $this->getData(self::ID_INDEX);
        set => $this->setData(self::ID_INDEX, $value);
    }

    // sunrise
    public const string SUNRISE = 'sunrise';
    private const int SUNRISE_INDEX = 2;

    public ?int $sunrise {
        get => $this->getData(self::SUNRISE_INDEX);
        set => $this->setData(self::SUNRISE_INDEX, $value);
    }

    // sunset
    public const string SUNSET = 'sunset';
    private const int SUNSET_INDEX = 3;

    public ?int $sunset {
        get => $this->getData(self::SUNSET_INDEX);
        set => $this->setData(self::SUNSET_INDEX, $value);
    }

    // type
    public const string TYPE = 'type';
    private const int TYPE_INDEX = 4;

    public ?int $type {
        get => $this->getData(self::TYPE_INDEX);
        set => $this->setData(self::TYPE_INDEX, $value);
    }
}
