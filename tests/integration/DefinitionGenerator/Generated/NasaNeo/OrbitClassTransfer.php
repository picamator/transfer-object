<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class OrbitClassTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::ORBIT_CLASS_DESCRIPTION => self::ORBIT_CLASS_DESCRIPTION_DATA_NAME,
        self::ORBIT_CLASS_RANGE => self::ORBIT_CLASS_RANGE_DATA_NAME,
        self::ORBIT_CLASS_TYPE => self::ORBIT_CLASS_TYPE_DATA_NAME,
    ];

    // orbit_class_description
    public const string ORBIT_CLASS_DESCRIPTION = 'orbit_class_description';
    protected const string ORBIT_CLASS_DESCRIPTION_DATA_NAME = 'ORBIT_CLASS_DESCRIPTION';
    protected const int ORBIT_CLASS_DESCRIPTION_DATA_INDEX = 0;

    public ?string $orbit_class_description {
        get => $this->getData(self::ORBIT_CLASS_DESCRIPTION_DATA_INDEX, false);
        set => $this->setData(self::ORBIT_CLASS_DESCRIPTION_DATA_INDEX, $value);
    }

    // orbit_class_range
    public const string ORBIT_CLASS_RANGE = 'orbit_class_range';
    protected const string ORBIT_CLASS_RANGE_DATA_NAME = 'ORBIT_CLASS_RANGE';
    protected const int ORBIT_CLASS_RANGE_DATA_INDEX = 1;

    public ?string $orbit_class_range {
        get => $this->getData(self::ORBIT_CLASS_RANGE_DATA_INDEX, false);
        set => $this->setData(self::ORBIT_CLASS_RANGE_DATA_INDEX, $value);
    }

    // orbit_class_type
    public const string ORBIT_CLASS_TYPE = 'orbit_class_type';
    protected const string ORBIT_CLASS_TYPE_DATA_NAME = 'ORBIT_CLASS_TYPE';
    protected const int ORBIT_CLASS_TYPE_DATA_INDEX = 2;

    public ?string $orbit_class_type {
        get => $this->getData(self::ORBIT_CLASS_TYPE_DATA_INDEX, false);
        set => $this->setData(self::ORBIT_CLASS_TYPE_DATA_INDEX, $value);
    }
}
