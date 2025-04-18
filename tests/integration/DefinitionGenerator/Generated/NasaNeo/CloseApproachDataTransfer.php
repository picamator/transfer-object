<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;
use Picamator\TransferObject\Transfer\TransferTrait;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class CloseApproachDataTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 6;

    protected const array META_DATA = [
        self::CLOSE_APPROACH_DATE => self::CLOSE_APPROACH_DATE_DATA_NAME,
        self::CLOSE_APPROACH_DATE_FULL => self::CLOSE_APPROACH_DATE_FULL_DATA_NAME,
        self::EPOCH_DATE_CLOSE_APPROACH => self::EPOCH_DATE_CLOSE_APPROACH_DATA_NAME,
        self::MISS_DISTANCE => self::MISS_DISTANCE_DATA_NAME,
        self::ORBITING_BODY => self::ORBITING_BODY_DATA_NAME,
        self::RELATIVE_VELOCITY => self::RELATIVE_VELOCITY_DATA_NAME,
    ];

    // close_approach_date
    public const string CLOSE_APPROACH_DATE = 'close_approach_date';
    protected const string CLOSE_APPROACH_DATE_DATA_NAME = 'CLOSE_APPROACH_DATE';
    protected const int CLOSE_APPROACH_DATE_DATA_INDEX = 0;

    public ?string $close_approach_date {
        get => $this->getData(self::CLOSE_APPROACH_DATE_DATA_INDEX, false);
        set => $this->setData(self::CLOSE_APPROACH_DATE_DATA_INDEX, $value);
    }

    // close_approach_date_full
    public const string CLOSE_APPROACH_DATE_FULL = 'close_approach_date_full';
    protected const string CLOSE_APPROACH_DATE_FULL_DATA_NAME = 'CLOSE_APPROACH_DATE_FULL';
    protected const int CLOSE_APPROACH_DATE_FULL_DATA_INDEX = 1;

    public ?string $close_approach_date_full {
        get => $this->getData(self::CLOSE_APPROACH_DATE_FULL_DATA_INDEX, false);
        set => $this->setData(self::CLOSE_APPROACH_DATE_FULL_DATA_INDEX, $value);
    }

    // epoch_date_close_approach
    public const string EPOCH_DATE_CLOSE_APPROACH = 'epoch_date_close_approach';
    protected const string EPOCH_DATE_CLOSE_APPROACH_DATA_NAME = 'EPOCH_DATE_CLOSE_APPROACH';
    protected const int EPOCH_DATE_CLOSE_APPROACH_DATA_INDEX = 2;

    public ?int $epoch_date_close_approach {
        get => $this->getData(self::EPOCH_DATE_CLOSE_APPROACH_DATA_INDEX, false);
        set => $this->setData(self::EPOCH_DATE_CLOSE_APPROACH_DATA_INDEX, $value);
    }

    // miss_distance
    #[PropertyTypeAttribute(MissDistanceTransfer::class)]
    public const string MISS_DISTANCE = 'miss_distance';
    protected const string MISS_DISTANCE_DATA_NAME = 'MISS_DISTANCE';
    protected const int MISS_DISTANCE_DATA_INDEX = 3;

    public ?MissDistanceTransfer $miss_distance {
        get => $this->getData(self::MISS_DISTANCE_DATA_INDEX, false);
        set => $this->setData(self::MISS_DISTANCE_DATA_INDEX, $value);
    }

    // orbiting_body
    public const string ORBITING_BODY = 'orbiting_body';
    protected const string ORBITING_BODY_DATA_NAME = 'ORBITING_BODY';
    protected const int ORBITING_BODY_DATA_INDEX = 4;

    public ?string $orbiting_body {
        get => $this->getData(self::ORBITING_BODY_DATA_INDEX, false);
        set => $this->setData(self::ORBITING_BODY_DATA_INDEX, $value);
    }

    // relative_velocity
    #[PropertyTypeAttribute(RelativeVelocityTransfer::class)]
    public const string RELATIVE_VELOCITY = 'relative_velocity';
    protected const string RELATIVE_VELOCITY_DATA_NAME = 'RELATIVE_VELOCITY';
    protected const int RELATIVE_VELOCITY_DATA_INDEX = 5;

    public ?RelativeVelocityTransfer $relative_velocity {
        get => $this->getData(self::RELATIVE_VELOCITY_DATA_INDEX, false);
        set => $this->setData(self::RELATIVE_VELOCITY_DATA_INDEX, $value);
    }
}
