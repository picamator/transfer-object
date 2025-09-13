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
        self::ASTRONOMICAL_INDEX => self::ASTRONOMICAL,
        self::KILOMETERS_INDEX => self::KILOMETERS,
        self::LUNAR_INDEX => self::LUNAR,
        self::MILES_INDEX => self::MILES,
    ];

    // astronomical
    public const string ASTRONOMICAL = 'astronomical';
    protected const int ASTRONOMICAL_INDEX = 0;

    public ?string $astronomical {
        get => $this->getData(self::ASTRONOMICAL_INDEX);
        set => $this->setData(self::ASTRONOMICAL_INDEX, $value);
    }

    // kilometers
    public const string KILOMETERS = 'kilometers';
    protected const int KILOMETERS_INDEX = 1;

    public ?string $kilometers {
        get => $this->getData(self::KILOMETERS_INDEX);
        set => $this->setData(self::KILOMETERS_INDEX, $value);
    }

    // lunar
    public const string LUNAR = 'lunar';
    protected const int LUNAR_INDEX = 2;

    public ?string $lunar {
        get => $this->getData(self::LUNAR_INDEX);
        set => $this->setData(self::LUNAR_INDEX, $value);
    }

    // miles
    public const string MILES = 'miles';
    protected const int MILES_INDEX = 3;

    public ?string $miles {
        get => $this->getData(self::MILES_INDEX);
        set => $this->setData(self::MILES_INDEX, $value);
    }
}
