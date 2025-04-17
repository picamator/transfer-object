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
final class OrbitalDataTransfer extends AbstractTransfer
{
    use TransferTrait;

    protected const int META_DATA_SIZE = 23;

    protected const array META_DATA = [
        self::APHELION_DISTANCE => self::APHELION_DISTANCE_DATA_NAME,
        self::ASCENDING_NODE_LONGITUDE => self::ASCENDING_NODE_LONGITUDE_DATA_NAME,
        self::DATA_ARC_IN_DAYS => self::DATA_ARC_IN_DAYS_DATA_NAME,
        self::ECCENTRICITY => self::ECCENTRICITY_DATA_NAME,
        self::EPOCH_OSCULATION => self::EPOCH_OSCULATION_DATA_NAME,
        self::EQUINOX => self::EQUINOX_DATA_NAME,
        self::FIRST_OBSERVATION_DATE => self::FIRST_OBSERVATION_DATE_DATA_NAME,
        self::INCLINATION => self::INCLINATION_DATA_NAME,
        self::JUPITER_TISSERAND_INVARIANT => self::JUPITER_TISSERAND_INVARIANT_DATA_NAME,
        self::LAST_OBSERVATION_DATE => self::LAST_OBSERVATION_DATE_DATA_NAME,
        self::MEAN_ANOMALY => self::MEAN_ANOMALY_DATA_NAME,
        self::MEAN_MOTION => self::MEAN_MOTION_DATA_NAME,
        self::MINIMUM_ORBIT_INTERSECTION => self::MINIMUM_ORBIT_INTERSECTION_DATA_NAME,
        self::OBSERVATIONS_USED => self::OBSERVATIONS_USED_DATA_NAME,
        self::ORBIT_CLASS => self::ORBIT_CLASS_DATA_NAME,
        self::ORBIT_DETERMINATION_DATE => self::ORBIT_DETERMINATION_DATE_DATA_NAME,
        self::ORBIT_ID => self::ORBIT_ID_DATA_NAME,
        self::ORBIT_UNCERTAINTY => self::ORBIT_UNCERTAINTY_DATA_NAME,
        self::ORBITAL_PERIOD => self::ORBITAL_PERIOD_DATA_NAME,
        self::PERIHELION_ARGUMENT => self::PERIHELION_ARGUMENT_DATA_NAME,
        self::PERIHELION_DISTANCE => self::PERIHELION_DISTANCE_DATA_NAME,
        self::PERIHELION_TIME => self::PERIHELION_TIME_DATA_NAME,
        self::SEMI_MAJOR_AXIS => self::SEMI_MAJOR_AXIS_DATA_NAME,
    ];

    // aphelion_distance
    public const string APHELION_DISTANCE = 'aphelion_distance';
    protected const string APHELION_DISTANCE_DATA_NAME = 'APHELION_DISTANCE';
    protected const int APHELION_DISTANCE_DATA_INDEX = 0;

    public ?string $aphelion_distance {
        get => $this->getData(self::APHELION_DISTANCE_DATA_INDEX);
        set => $this->setData(self::APHELION_DISTANCE_DATA_INDEX, $value);
    }

    // ascending_node_longitude
    public const string ASCENDING_NODE_LONGITUDE = 'ascending_node_longitude';
    protected const string ASCENDING_NODE_LONGITUDE_DATA_NAME = 'ASCENDING_NODE_LONGITUDE';
    protected const int ASCENDING_NODE_LONGITUDE_DATA_INDEX = 1;

    public ?string $ascending_node_longitude {
        get => $this->getData(self::ASCENDING_NODE_LONGITUDE_DATA_INDEX);
        set => $this->setData(self::ASCENDING_NODE_LONGITUDE_DATA_INDEX, $value);
    }

    // data_arc_in_days
    public const string DATA_ARC_IN_DAYS = 'data_arc_in_days';
    protected const string DATA_ARC_IN_DAYS_DATA_NAME = 'DATA_ARC_IN_DAYS';
    protected const int DATA_ARC_IN_DAYS_DATA_INDEX = 2;

    public ?int $data_arc_in_days {
        get => $this->getData(self::DATA_ARC_IN_DAYS_DATA_INDEX);
        set => $this->setData(self::DATA_ARC_IN_DAYS_DATA_INDEX, $value);
    }

    // eccentricity
    public const string ECCENTRICITY = 'eccentricity';
    protected const string ECCENTRICITY_DATA_NAME = 'ECCENTRICITY';
    protected const int ECCENTRICITY_DATA_INDEX = 3;

    public ?string $eccentricity {
        get => $this->getData(self::ECCENTRICITY_DATA_INDEX);
        set => $this->setData(self::ECCENTRICITY_DATA_INDEX, $value);
    }

    // epoch_osculation
    public const string EPOCH_OSCULATION = 'epoch_osculation';
    protected const string EPOCH_OSCULATION_DATA_NAME = 'EPOCH_OSCULATION';
    protected const int EPOCH_OSCULATION_DATA_INDEX = 4;

    public ?string $epoch_osculation {
        get => $this->getData(self::EPOCH_OSCULATION_DATA_INDEX);
        set => $this->setData(self::EPOCH_OSCULATION_DATA_INDEX, $value);
    }

    // equinox
    public const string EQUINOX = 'equinox';
    protected const string EQUINOX_DATA_NAME = 'EQUINOX';
    protected const int EQUINOX_DATA_INDEX = 5;

    public ?string $equinox {
        get => $this->getData(self::EQUINOX_DATA_INDEX);
        set => $this->setData(self::EQUINOX_DATA_INDEX, $value);
    }

    // first_observation_date
    public const string FIRST_OBSERVATION_DATE = 'first_observation_date';
    protected const string FIRST_OBSERVATION_DATE_DATA_NAME = 'FIRST_OBSERVATION_DATE';
    protected const int FIRST_OBSERVATION_DATE_DATA_INDEX = 6;

    public ?string $first_observation_date {
        get => $this->getData(self::FIRST_OBSERVATION_DATE_DATA_INDEX);
        set => $this->setData(self::FIRST_OBSERVATION_DATE_DATA_INDEX, $value);
    }

    // inclination
    public const string INCLINATION = 'inclination';
    protected const string INCLINATION_DATA_NAME = 'INCLINATION';
    protected const int INCLINATION_DATA_INDEX = 7;

    public ?string $inclination {
        get => $this->getData(self::INCLINATION_DATA_INDEX);
        set => $this->setData(self::INCLINATION_DATA_INDEX, $value);
    }

    // jupiter_tisserand_invariant
    public const string JUPITER_TISSERAND_INVARIANT = 'jupiter_tisserand_invariant';
    protected const string JUPITER_TISSERAND_INVARIANT_DATA_NAME = 'JUPITER_TISSERAND_INVARIANT';
    protected const int JUPITER_TISSERAND_INVARIANT_DATA_INDEX = 8;

    public ?string $jupiter_tisserand_invariant {
        get => $this->getData(self::JUPITER_TISSERAND_INVARIANT_DATA_INDEX);
        set => $this->setData(self::JUPITER_TISSERAND_INVARIANT_DATA_INDEX, $value);
    }

    // last_observation_date
    public const string LAST_OBSERVATION_DATE = 'last_observation_date';
    protected const string LAST_OBSERVATION_DATE_DATA_NAME = 'LAST_OBSERVATION_DATE';
    protected const int LAST_OBSERVATION_DATE_DATA_INDEX = 9;

    public ?string $last_observation_date {
        get => $this->getData(self::LAST_OBSERVATION_DATE_DATA_INDEX);
        set => $this->setData(self::LAST_OBSERVATION_DATE_DATA_INDEX, $value);
    }

    // mean_anomaly
    public const string MEAN_ANOMALY = 'mean_anomaly';
    protected const string MEAN_ANOMALY_DATA_NAME = 'MEAN_ANOMALY';
    protected const int MEAN_ANOMALY_DATA_INDEX = 10;

    public ?string $mean_anomaly {
        get => $this->getData(self::MEAN_ANOMALY_DATA_INDEX);
        set => $this->setData(self::MEAN_ANOMALY_DATA_INDEX, $value);
    }

    // mean_motion
    public const string MEAN_MOTION = 'mean_motion';
    protected const string MEAN_MOTION_DATA_NAME = 'MEAN_MOTION';
    protected const int MEAN_MOTION_DATA_INDEX = 11;

    public ?string $mean_motion {
        get => $this->getData(self::MEAN_MOTION_DATA_INDEX);
        set => $this->setData(self::MEAN_MOTION_DATA_INDEX, $value);
    }

    // minimum_orbit_intersection
    public const string MINIMUM_ORBIT_INTERSECTION = 'minimum_orbit_intersection';
    protected const string MINIMUM_ORBIT_INTERSECTION_DATA_NAME = 'MINIMUM_ORBIT_INTERSECTION';
    protected const int MINIMUM_ORBIT_INTERSECTION_DATA_INDEX = 12;

    public ?string $minimum_orbit_intersection {
        get => $this->getData(self::MINIMUM_ORBIT_INTERSECTION_DATA_INDEX);
        set => $this->setData(self::MINIMUM_ORBIT_INTERSECTION_DATA_INDEX, $value);
    }

    // observations_used
    public const string OBSERVATIONS_USED = 'observations_used';
    protected const string OBSERVATIONS_USED_DATA_NAME = 'OBSERVATIONS_USED';
    protected const int OBSERVATIONS_USED_DATA_INDEX = 13;

    public ?int $observations_used {
        get => $this->getData(self::OBSERVATIONS_USED_DATA_INDEX);
        set => $this->setData(self::OBSERVATIONS_USED_DATA_INDEX, $value);
    }

    // orbit_class
    #[PropertyTypeAttribute(OrbitClassTransfer::class)]
    public const string ORBIT_CLASS = 'orbit_class';
    protected const string ORBIT_CLASS_DATA_NAME = 'ORBIT_CLASS';
    protected const int ORBIT_CLASS_DATA_INDEX = 14;

    public ?OrbitClassTransfer $orbit_class {
        get => $this->getData(self::ORBIT_CLASS_DATA_INDEX);
        set => $this->setData(self::ORBIT_CLASS_DATA_INDEX, $value);
    }

    // orbit_determination_date
    public const string ORBIT_DETERMINATION_DATE = 'orbit_determination_date';
    protected const string ORBIT_DETERMINATION_DATE_DATA_NAME = 'ORBIT_DETERMINATION_DATE';
    protected const int ORBIT_DETERMINATION_DATE_DATA_INDEX = 15;

    public ?string $orbit_determination_date {
        get => $this->getData(self::ORBIT_DETERMINATION_DATE_DATA_INDEX);
        set => $this->setData(self::ORBIT_DETERMINATION_DATE_DATA_INDEX, $value);
    }

    // orbit_id
    public const string ORBIT_ID = 'orbit_id';
    protected const string ORBIT_ID_DATA_NAME = 'ORBIT_ID';
    protected const int ORBIT_ID_DATA_INDEX = 16;

    public ?string $orbit_id {
        get => $this->getData(self::ORBIT_ID_DATA_INDEX);
        set => $this->setData(self::ORBIT_ID_DATA_INDEX, $value);
    }

    // orbit_uncertainty
    public const string ORBIT_UNCERTAINTY = 'orbit_uncertainty';
    protected const string ORBIT_UNCERTAINTY_DATA_NAME = 'ORBIT_UNCERTAINTY';
    protected const int ORBIT_UNCERTAINTY_DATA_INDEX = 17;

    public ?string $orbit_uncertainty {
        get => $this->getData(self::ORBIT_UNCERTAINTY_DATA_INDEX);
        set => $this->setData(self::ORBIT_UNCERTAINTY_DATA_INDEX, $value);
    }

    // orbital_period
    public const string ORBITAL_PERIOD = 'orbital_period';
    protected const string ORBITAL_PERIOD_DATA_NAME = 'ORBITAL_PERIOD';
    protected const int ORBITAL_PERIOD_DATA_INDEX = 18;

    public ?string $orbital_period {
        get => $this->getData(self::ORBITAL_PERIOD_DATA_INDEX);
        set => $this->setData(self::ORBITAL_PERIOD_DATA_INDEX, $value);
    }

    // perihelion_argument
    public const string PERIHELION_ARGUMENT = 'perihelion_argument';
    protected const string PERIHELION_ARGUMENT_DATA_NAME = 'PERIHELION_ARGUMENT';
    protected const int PERIHELION_ARGUMENT_DATA_INDEX = 19;

    public ?string $perihelion_argument {
        get => $this->getData(self::PERIHELION_ARGUMENT_DATA_INDEX);
        set => $this->setData(self::PERIHELION_ARGUMENT_DATA_INDEX, $value);
    }

    // perihelion_distance
    public const string PERIHELION_DISTANCE = 'perihelion_distance';
    protected const string PERIHELION_DISTANCE_DATA_NAME = 'PERIHELION_DISTANCE';
    protected const int PERIHELION_DISTANCE_DATA_INDEX = 20;

    public ?string $perihelion_distance {
        get => $this->getData(self::PERIHELION_DISTANCE_DATA_INDEX);
        set => $this->setData(self::PERIHELION_DISTANCE_DATA_INDEX, $value);
    }

    // perihelion_time
    public const string PERIHELION_TIME = 'perihelion_time';
    protected const string PERIHELION_TIME_DATA_NAME = 'PERIHELION_TIME';
    protected const int PERIHELION_TIME_DATA_INDEX = 21;

    public ?string $perihelion_time {
        get => $this->getData(self::PERIHELION_TIME_DATA_INDEX);
        set => $this->setData(self::PERIHELION_TIME_DATA_INDEX, $value);
    }

    // semi_major_axis
    public const string SEMI_MAJOR_AXIS = 'semi_major_axis';
    protected const string SEMI_MAJOR_AXIS_DATA_NAME = 'SEMI_MAJOR_AXIS';
    protected const int SEMI_MAJOR_AXIS_DATA_INDEX = 22;

    public ?string $semi_major_axis {
        get => $this->getData(self::SEMI_MAJOR_AXIS_DATA_INDEX);
        set => $this->setData(self::SEMI_MAJOR_AXIS_DATA_INDEX, $value);
    }
}
