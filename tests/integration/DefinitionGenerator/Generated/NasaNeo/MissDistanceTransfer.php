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
final class MissDistanceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::ASTRONOMICAL_PROP => self::ASTRONOMICAL_INDEX,
        self::KILOMETERS_PROP => self::KILOMETERS_INDEX,
        self::LUNAR_PROP => self::LUNAR_INDEX,
        self::MILES_PROP => self::MILES_INDEX,
    ];

    // astronomical
    public const string ASTRONOMICAL_PROP = 'astronomical';
    private const int ASTRONOMICAL_INDEX = 0;

    public ?string $astronomical {
        get => $this->getData(self::ASTRONOMICAL_INDEX);
        set => $this->setData(self::ASTRONOMICAL_INDEX, $value);
    }

    // kilometers
    public const string KILOMETERS_PROP = 'kilometers';
    private const int KILOMETERS_INDEX = 1;

    public ?string $kilometers {
        get => $this->getData(self::KILOMETERS_INDEX);
        set => $this->setData(self::KILOMETERS_INDEX, $value);
    }

    // lunar
    public const string LUNAR_PROP = 'lunar';
    private const int LUNAR_INDEX = 2;

    public ?string $lunar {
        get => $this->getData(self::LUNAR_INDEX);
        set => $this->setData(self::LUNAR_INDEX, $value);
    }

    // miles
    public const string MILES_PROP = 'miles';
    private const int MILES_INDEX = 3;

    public ?string $miles {
        get => $this->getData(self::MILES_INDEX);
        set => $this->setData(self::MILES_INDEX, $value);
    }
}
