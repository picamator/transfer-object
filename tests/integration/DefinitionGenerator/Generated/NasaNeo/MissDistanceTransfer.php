<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class MissDistanceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::ASTRONOMICAL => self::ASTRONOMICAL_DATA_NAME,
        self::KILOMETERS => self::KILOMETERS_DATA_NAME,
        self::LUNAR => self::LUNAR_DATA_NAME,
        self::MILES => self::MILES_DATA_NAME,
    ];

    // astronomical
    public const string ASTRONOMICAL = 'astronomical';
    protected const string ASTRONOMICAL_DATA_NAME = 'ASTRONOMICAL';
    protected const int ASTRONOMICAL_DATA_INDEX = 0;

    public ?string $astronomical {
        get => $this->_data[self::ASTRONOMICAL_DATA_INDEX];
        set => $this->_data[self::ASTRONOMICAL_DATA_INDEX] = $value;
    }

    // kilometers
    public const string KILOMETERS = 'kilometers';
    protected const string KILOMETERS_DATA_NAME = 'KILOMETERS';
    protected const int KILOMETERS_DATA_INDEX = 1;

    public ?string $kilometers {
        get => $this->_data[self::KILOMETERS_DATA_INDEX];
        set => $this->_data[self::KILOMETERS_DATA_INDEX] = $value;
    }

    // lunar
    public const string LUNAR = 'lunar';
    protected const string LUNAR_DATA_NAME = 'LUNAR';
    protected const int LUNAR_DATA_INDEX = 2;

    public ?string $lunar {
        get => $this->_data[self::LUNAR_DATA_INDEX];
        set => $this->_data[self::LUNAR_DATA_INDEX] = $value;
    }

    // miles
    public const string MILES = 'miles';
    protected const string MILES_DATA_NAME = 'MILES';
    protected const int MILES_DATA_INDEX = 3;

    public ?string $miles {
        get => $this->_data[self::MILES_DATA_INDEX];
        set => $this->_data[self::MILES_DATA_INDEX] = $value;
    }
}
