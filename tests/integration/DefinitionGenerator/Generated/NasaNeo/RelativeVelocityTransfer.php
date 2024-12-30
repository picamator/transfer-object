<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class RelativeVelocityTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::KILOMETERS_PER_HOUR => self::KILOMETERS_PER_HOUR_DATA_NAME,
        self::KILOMETERS_PER_SECOND => self::KILOMETERS_PER_SECOND_DATA_NAME,
        self::MILES_PER_HOUR => self::MILES_PER_HOUR_DATA_NAME,
    ];

    // kilometers_per_hour
    public const string KILOMETERS_PER_HOUR = 'kilometers_per_hour';
    protected const string KILOMETERS_PER_HOUR_DATA_NAME = 'KILOMETERS_PER_HOUR';
    protected const int KILOMETERS_PER_HOUR_DATA_INDEX = 0;

    public ?string $kilometers_per_hour {
        get => $this->_data[self::KILOMETERS_PER_HOUR_DATA_INDEX];
        set => $this->_data[self::KILOMETERS_PER_HOUR_DATA_INDEX] = $value;
    }

    // kilometers_per_second
    public const string KILOMETERS_PER_SECOND = 'kilometers_per_second';
    protected const string KILOMETERS_PER_SECOND_DATA_NAME = 'KILOMETERS_PER_SECOND';
    protected const int KILOMETERS_PER_SECOND_DATA_INDEX = 1;

    public ?string $kilometers_per_second {
        get => $this->_data[self::KILOMETERS_PER_SECOND_DATA_INDEX];
        set => $this->_data[self::KILOMETERS_PER_SECOND_DATA_INDEX] = $value;
    }

    // miles_per_hour
    public const string MILES_PER_HOUR = 'miles_per_hour';
    protected const string MILES_PER_HOUR_DATA_NAME = 'MILES_PER_HOUR';
    protected const int MILES_PER_HOUR_DATA_INDEX = 2;

    public ?string $miles_per_hour {
        get => $this->_data[self::MILES_PER_HOUR_DATA_INDEX];
        set => $this->_data[self::MILES_PER_HOUR_DATA_INDEX] = $value;
    }
}
