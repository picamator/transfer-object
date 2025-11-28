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
final class CloseApproachDataTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 6;

    protected const array META_DATA = [
        self::CLOSE_APPROACH_DATE_PROP => self::CLOSE_APPROACH_DATE_INDEX,
        self::CLOSE_APPROACH_DATE_FULL_PROP => self::CLOSE_APPROACH_DATE_FULL_INDEX,
        self::EPOCH_DATE_CLOSE_APPROACH_PROP => self::EPOCH_DATE_CLOSE_APPROACH_INDEX,
        self::MISS_DISTANCE_PROP => self::MISS_DISTANCE_INDEX,
        self::ORBITING_BODY_PROP => self::ORBITING_BODY_INDEX,
        self::RELATIVE_VELOCITY_PROP => self::RELATIVE_VELOCITY_INDEX,
    ];

    // close_approach_date
    public const string CLOSE_APPROACH_DATE_PROP = 'close_approach_date';
    private const int CLOSE_APPROACH_DATE_INDEX = 0;

    public ?string $close_approach_date {
        get => $this->getData(self::CLOSE_APPROACH_DATE_INDEX);
        set => $this->setData(self::CLOSE_APPROACH_DATE_INDEX, $value);
    }

    // close_approach_date_full
    public const string CLOSE_APPROACH_DATE_FULL_PROP = 'close_approach_date_full';
    private const int CLOSE_APPROACH_DATE_FULL_INDEX = 1;

    public ?string $close_approach_date_full {
        get => $this->getData(self::CLOSE_APPROACH_DATE_FULL_INDEX);
        set => $this->setData(self::CLOSE_APPROACH_DATE_FULL_INDEX, $value);
    }

    // epoch_date_close_approach
    public const string EPOCH_DATE_CLOSE_APPROACH_PROP = 'epoch_date_close_approach';
    private const int EPOCH_DATE_CLOSE_APPROACH_INDEX = 2;

    public ?int $epoch_date_close_approach {
        get => $this->getData(self::EPOCH_DATE_CLOSE_APPROACH_INDEX);
        set => $this->setData(self::EPOCH_DATE_CLOSE_APPROACH_INDEX, $value);
    }

    // miss_distance
    #[TransferTransformerAttribute(MissDistanceTransfer::class)]
    public const string MISS_DISTANCE_PROP = 'miss_distance';
    private const int MISS_DISTANCE_INDEX = 3;

    public ?MissDistanceTransfer $miss_distance {
        get => $this->getData(self::MISS_DISTANCE_INDEX);
        set => $this->setData(self::MISS_DISTANCE_INDEX, $value);
    }

    // orbiting_body
    public const string ORBITING_BODY_PROP = 'orbiting_body';
    private const int ORBITING_BODY_INDEX = 4;

    public ?string $orbiting_body {
        get => $this->getData(self::ORBITING_BODY_INDEX);
        set => $this->setData(self::ORBITING_BODY_INDEX, $value);
    }

    // relative_velocity
    #[TransferTransformerAttribute(RelativeVelocityTransfer::class)]
    public const string RELATIVE_VELOCITY_PROP = 'relative_velocity';
    private const int RELATIVE_VELOCITY_INDEX = 5;

    public ?RelativeVelocityTransfer $relative_velocity {
        get => $this->getData(self::RELATIVE_VELOCITY_INDEX);
        set => $this->setData(self::RELATIVE_VELOCITY_INDEX, $value);
    }
}
