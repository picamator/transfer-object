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
final class KilometersTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::ESTIMATED_DIAMETER_MAX_PROP => self::ESTIMATED_DIAMETER_MAX_INDEX,
        self::ESTIMATED_DIAMETER_MIN_PROP => self::ESTIMATED_DIAMETER_MIN_INDEX,
    ];

    // estimated_diameter_max
    public const string ESTIMATED_DIAMETER_MAX_PROP = 'estimated_diameter_max';
    private const int ESTIMATED_DIAMETER_MAX_INDEX = 0;

    public ?float $estimated_diameter_max {
        get => $this->getData(self::ESTIMATED_DIAMETER_MAX_INDEX);
        set => $this->setData(self::ESTIMATED_DIAMETER_MAX_INDEX, $value);
    }

    // estimated_diameter_min
    public const string ESTIMATED_DIAMETER_MIN_PROP = 'estimated_diameter_min';
    private const int ESTIMATED_DIAMETER_MIN_INDEX = 1;

    public ?float $estimated_diameter_min {
        get => $this->getData(self::ESTIMATED_DIAMETER_MIN_INDEX);
        set => $this->setData(self::ESTIMATED_DIAMETER_MIN_INDEX, $value);
    }
}
