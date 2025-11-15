<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/nasa-neo-rest-v1-neo-2465633/definition/asteroid.transfer.yml Definition file path.
 */
final class EstimatedDiameterTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::FEET => self::FEET_INDEX,
        self::KILOMETERS => self::KILOMETERS_INDEX,
        self::METERS => self::METERS_INDEX,
        self::MILES => self::MILES_INDEX,
    ];

    // feet
    #[TransferTransformerAttribute(FeetTransfer::class)]
    public const string FEET = 'feet';
    private const int FEET_INDEX = 0;

    public ?FeetTransfer $feet {
        get => $this->getData(self::FEET_INDEX);
        set => $this->setData(self::FEET_INDEX, $value);
    }

    // kilometers
    #[TransferTransformerAttribute(KilometersTransfer::class)]
    public const string KILOMETERS = 'kilometers';
    private const int KILOMETERS_INDEX = 1;

    public ?KilometersTransfer $kilometers {
        get => $this->getData(self::KILOMETERS_INDEX);
        set => $this->setData(self::KILOMETERS_INDEX, $value);
    }

    // meters
    #[TransferTransformerAttribute(MetersTransfer::class)]
    public const string METERS = 'meters';
    private const int METERS_INDEX = 2;

    public ?MetersTransfer $meters {
        get => $this->getData(self::METERS_INDEX);
        set => $this->setData(self::METERS_INDEX, $value);
    }

    // miles
    #[TransferTransformerAttribute(MilesTransfer::class)]
    public const string MILES = 'miles';
    private const int MILES_INDEX = 3;

    public ?MilesTransfer $miles {
        get => $this->getData(self::MILES_INDEX);
        set => $this->setData(self::MILES_INDEX, $value);
    }
}
