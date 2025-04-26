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
        self::ESTIMATED_DIAMETER_MAX => self::ESTIMATED_DIAMETER_MAX_DATA_NAME,
        self::ESTIMATED_DIAMETER_MIN => self::ESTIMATED_DIAMETER_MIN_DATA_NAME,
    ];

    // estimated_diameter_max
    public const string ESTIMATED_DIAMETER_MAX = 'estimated_diameter_max';
    protected const string ESTIMATED_DIAMETER_MAX_DATA_NAME = 'ESTIMATED_DIAMETER_MAX';
    protected const int ESTIMATED_DIAMETER_MAX_DATA_INDEX = 0;

    public ?float $estimated_diameter_max {
        get => $this->_data[self::ESTIMATED_DIAMETER_MAX_DATA_INDEX];
        set => $this->_data[self::ESTIMATED_DIAMETER_MAX_DATA_INDEX] = $value;
    }

    // estimated_diameter_min
    public const string ESTIMATED_DIAMETER_MIN = 'estimated_diameter_min';
    protected const string ESTIMATED_DIAMETER_MIN_DATA_NAME = 'ESTIMATED_DIAMETER_MIN';
    protected const int ESTIMATED_DIAMETER_MIN_DATA_INDEX = 1;

    public ?float $estimated_diameter_min {
        get => $this->_data[self::ESTIMATED_DIAMETER_MIN_DATA_INDEX];
        set => $this->_data[self::ESTIMATED_DIAMETER_MIN_DATA_INDEX] = $value;
    }
}
