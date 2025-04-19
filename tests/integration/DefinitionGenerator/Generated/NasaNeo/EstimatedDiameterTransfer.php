<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class EstimatedDiameterTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::FEET => self::FEET_DATA_NAME,
        self::KILOMETERS => self::KILOMETERS_DATA_NAME,
        self::METERS => self::METERS_DATA_NAME,
        self::MILES => self::MILES_DATA_NAME,
    ];

    // feet
    #[PropertyTypeAttribute(FeetTransfer::class)]
    public const string FEET = 'feet';
    protected const string FEET_DATA_NAME = 'FEET';
    protected const int FEET_DATA_INDEX = 0;

    public ?FeetTransfer $feet {
        get => $this->_data[self::FEET_DATA_INDEX];
        set => $this->_data[self::FEET_DATA_INDEX] = $value;
    }

    // kilometers
    #[PropertyTypeAttribute(KilometersTransfer::class)]
    public const string KILOMETERS = 'kilometers';
    protected const string KILOMETERS_DATA_NAME = 'KILOMETERS';
    protected const int KILOMETERS_DATA_INDEX = 1;

    public ?KilometersTransfer $kilometers {
        get => $this->_data[self::KILOMETERS_DATA_INDEX];
        set => $this->_data[self::KILOMETERS_DATA_INDEX] = $value;
    }

    // meters
    #[PropertyTypeAttribute(MetersTransfer::class)]
    public const string METERS = 'meters';
    protected const string METERS_DATA_NAME = 'METERS';
    protected const int METERS_DATA_INDEX = 2;

    public ?MetersTransfer $meters {
        get => $this->_data[self::METERS_DATA_INDEX];
        set => $this->_data[self::METERS_DATA_INDEX] = $value;
    }

    // miles
    #[PropertyTypeAttribute(MilesTransfer::class)]
    public const string MILES = 'miles';
    protected const string MILES_DATA_NAME = 'MILES';
    protected const int MILES_DATA_INDEX = 3;

    public ?MilesTransfer $miles {
        get => $this->_data[self::MILES_DATA_INDEX];
        set => $this->_data[self::MILES_DATA_INDEX] = $value;
    }
}
