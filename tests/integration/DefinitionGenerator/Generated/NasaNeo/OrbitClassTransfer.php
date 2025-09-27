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
final class OrbitClassTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::ORBIT_CLASS_DESCRIPTION_INDEX => self::ORBIT_CLASS_DESCRIPTION,
        self::ORBIT_CLASS_RANGE_INDEX => self::ORBIT_CLASS_RANGE,
        self::ORBIT_CLASS_TYPE_INDEX => self::ORBIT_CLASS_TYPE,
    ];

    // orbit_class_description
    public const string ORBIT_CLASS_DESCRIPTION = 'orbit_class_description';
    private const int ORBIT_CLASS_DESCRIPTION_INDEX = 0;

    public ?string $orbit_class_description {
        get => $this->getData(self::ORBIT_CLASS_DESCRIPTION_INDEX);
        set => $this->setData(self::ORBIT_CLASS_DESCRIPTION_INDEX, $value);
    }

    // orbit_class_range
    public const string ORBIT_CLASS_RANGE = 'orbit_class_range';
    private const int ORBIT_CLASS_RANGE_INDEX = 1;

    public ?string $orbit_class_range {
        get => $this->getData(self::ORBIT_CLASS_RANGE_INDEX);
        set => $this->setData(self::ORBIT_CLASS_RANGE_INDEX, $value);
    }

    // orbit_class_type
    public const string ORBIT_CLASS_TYPE = 'orbit_class_type';
    private const int ORBIT_CLASS_TYPE_INDEX = 2;

    public ?string $orbit_class_type {
        get => $this->getData(self::ORBIT_CLASS_TYPE_INDEX);
        set => $this->setData(self::ORBIT_CLASS_TYPE_INDEX, $value);
    }
}
