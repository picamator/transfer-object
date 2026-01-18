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
final class WindTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::DEG_PROP => self::DEG_INDEX,
        self::GUST_PROP => self::GUST_INDEX,
        self::SPEED_PROP => self::SPEED_INDEX,
    ];

    // deg
    public const string DEG_PROP = 'deg';
    private const int DEG_INDEX = 0;

    public ?int $deg {
        get => $this->getData(self::DEG_INDEX);
        set {
            $this->setData(self::DEG_INDEX, $value);
        }
    }

    // gust
    public const string GUST_PROP = 'gust';
    private const int GUST_INDEX = 1;

    public ?float $gust {
        get => $this->getData(self::GUST_INDEX);
        set {
            $this->setData(self::GUST_INDEX, $value);
        }
    }

    // speed
    public const string SPEED_PROP = 'speed';
    private const int SPEED_INDEX = 2;

    public ?float $speed {
        get => $this->getData(self::SPEED_INDEX);
        set {
            $this->setData(self::SPEED_INDEX, $value);
        }
    }
}
