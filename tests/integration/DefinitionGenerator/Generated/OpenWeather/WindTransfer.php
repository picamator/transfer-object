<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\OpenWeather;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class WindTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::DEG => self::DEG_DATA_NAME,
        self::GUST => self::GUST_DATA_NAME,
        self::SPEED => self::SPEED_DATA_NAME,
    ];

    // deg
    public const string DEG = 'deg';
    protected const string DEG_DATA_NAME = 'DEG';
    protected const int DEG_DATA_INDEX = 0;

    public ?int $deg {
        get => $this->getData(self::DEG_DATA_INDEX);
        set => $this->setData(self::DEG_DATA_INDEX, $value);
    }

    // gust
    public const string GUST = 'gust';
    protected const string GUST_DATA_NAME = 'GUST';
    protected const int GUST_DATA_INDEX = 1;

    public ?float $gust {
        get => $this->getData(self::GUST_DATA_INDEX);
        set => $this->setData(self::GUST_DATA_INDEX, $value);
    }

    // speed
    public const string SPEED = 'speed';
    protected const string SPEED_DATA_NAME = 'SPEED';
    protected const int SPEED_DATA_INDEX = 2;

    public ?float $speed {
        get => $this->getData(self::SPEED_DATA_INDEX);
        set => $this->setData(self::SPEED_DATA_INDEX, $value);
    }
}