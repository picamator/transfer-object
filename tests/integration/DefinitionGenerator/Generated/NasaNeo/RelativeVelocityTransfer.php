<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/nasa-neo-rest-v1-neo-2465633/definition/asteroid.transfer.yml Definition file path.
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
        get => $this->getData(self::KILOMETERS_PER_HOUR_DATA_INDEX);
        set => $this->setData(self::KILOMETERS_PER_HOUR_DATA_INDEX, $value);
    }

    // kilometers_per_second
    public const string KILOMETERS_PER_SECOND = 'kilometers_per_second';
    protected const string KILOMETERS_PER_SECOND_DATA_NAME = 'KILOMETERS_PER_SECOND';
    protected const int KILOMETERS_PER_SECOND_DATA_INDEX = 1;

    public ?string $kilometers_per_second {
        get => $this->getData(self::KILOMETERS_PER_SECOND_DATA_INDEX);
        set => $this->setData(self::KILOMETERS_PER_SECOND_DATA_INDEX, $value);
    }

    // miles_per_hour
    public const string MILES_PER_HOUR = 'miles_per_hour';
    protected const string MILES_PER_HOUR_DATA_NAME = 'MILES_PER_HOUR';
    protected const int MILES_PER_HOUR_DATA_INDEX = 2;

    public ?string $miles_per_hour {
        get => $this->getData(self::MILES_PER_HOUR_DATA_INDEX);
        set => $this->setData(self::MILES_PER_HOUR_DATA_INDEX, $value);
    }
}
