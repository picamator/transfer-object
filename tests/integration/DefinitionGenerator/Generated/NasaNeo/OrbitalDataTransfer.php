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
 *
 * @see /tests/integration/DefinitionGenerator/data/config/nasa-neo-rest-v1-neo-2465633/definition/asteroid.transfer.yml Definition file path.
 */
final class OrbitalDataTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 23;

    protected const array META_DATA = [
        self::APHELION_DISTANCE_INDEX => self::APHELION_DISTANCE,
        self::ASCENDING_NODE_LONGITUDE_INDEX => self::ASCENDING_NODE_LONGITUDE,
        self::DATA_ARC_IN_DAYS_INDEX => self::DATA_ARC_IN_DAYS,
        self::ECCENTRICITY_INDEX => self::ECCENTRICITY,
        self::EPOCH_OSCULATION_INDEX => self::EPOCH_OSCULATION,
        self::EQUINOX_INDEX => self::EQUINOX,
        self::FIRST_OBSERVATION_DATE_INDEX => self::FIRST_OBSERVATION_DATE,
        self::INCLINATION_INDEX => self::INCLINATION,
        self::JUPITER_TISSERAND_INVARIANT_INDEX => self::JUPITER_TISSERAND_INVARIANT,
        self::LAST_OBSERVATION_DATE_INDEX => self::LAST_OBSERVATION_DATE,
        self::MEAN_ANOMALY_INDEX => self::MEAN_ANOMALY,
        self::MEAN_MOTION_INDEX => self::MEAN_MOTION,
        self::MINIMUM_ORBIT_INTERSECTION_INDEX => self::MINIMUM_ORBIT_INTERSECTION,
        self::OBSERVATIONS_USED_INDEX => self::OBSERVATIONS_USED,
        self::ORBIT_CLASS_INDEX => self::ORBIT_CLASS,
        self::ORBIT_DETERMINATION_DATE_INDEX => self::ORBIT_DETERMINATION_DATE,
        self::ORBIT_ID_INDEX => self::ORBIT_ID,
        self::ORBIT_UNCERTAINTY_INDEX => self::ORBIT_UNCERTAINTY,
        self::ORBITAL_PERIOD_INDEX => self::ORBITAL_PERIOD,
        self::PERIHELION_ARGUMENT_INDEX => self::PERIHELION_ARGUMENT,
        self::PERIHELION_DISTANCE_INDEX => self::PERIHELION_DISTANCE,
        self::PERIHELION_TIME_INDEX => self::PERIHELION_TIME,
        self::SEMI_MAJOR_AXIS_INDEX => self::SEMI_MAJOR_AXIS,
    ];

    // aphelion_distance
    public const string APHELION_DISTANCE = 'aphelion_distance';
    protected const int APHELION_DISTANCE_INDEX = 0;

    public ?string $aphelion_distance {
        get => $this->getData(self::APHELION_DISTANCE_INDEX);
        set => $this->setData(self::APHELION_DISTANCE_INDEX, $value);
    }

    // ascending_node_longitude
    public const string ASCENDING_NODE_LONGITUDE = 'ascending_node_longitude';
    protected const int ASCENDING_NODE_LONGITUDE_INDEX = 1;

    public ?string $ascending_node_longitude {
        get => $this->getData(self::ASCENDING_NODE_LONGITUDE_INDEX);
        set => $this->setData(self::ASCENDING_NODE_LONGITUDE_INDEX, $value);
    }

    // data_arc_in_days
    public const string DATA_ARC_IN_DAYS = 'data_arc_in_days';
    protected const int DATA_ARC_IN_DAYS_INDEX = 2;

    public ?int $data_arc_in_days {
        get => $this->getData(self::DATA_ARC_IN_DAYS_INDEX);
        set => $this->setData(self::DATA_ARC_IN_DAYS_INDEX, $value);
    }

    // eccentricity
    public const string ECCENTRICITY = 'eccentricity';
    protected const int ECCENTRICITY_INDEX = 3;

    public ?string $eccentricity {
        get => $this->getData(self::ECCENTRICITY_INDEX);
        set => $this->setData(self::ECCENTRICITY_INDEX, $value);
    }

    // epoch_osculation
    public const string EPOCH_OSCULATION = 'epoch_osculation';
    protected const int EPOCH_OSCULATION_INDEX = 4;

    public ?string $epoch_osculation {
        get => $this->getData(self::EPOCH_OSCULATION_INDEX);
        set => $this->setData(self::EPOCH_OSCULATION_INDEX, $value);
    }

    // equinox
    public const string EQUINOX = 'equinox';
    protected const int EQUINOX_INDEX = 5;

    public ?string $equinox {
        get => $this->getData(self::EQUINOX_INDEX);
        set => $this->setData(self::EQUINOX_INDEX, $value);
    }

    // first_observation_date
    public const string FIRST_OBSERVATION_DATE = 'first_observation_date';
    protected const int FIRST_OBSERVATION_DATE_INDEX = 6;

    public ?string $first_observation_date {
        get => $this->getData(self::FIRST_OBSERVATION_DATE_INDEX);
        set => $this->setData(self::FIRST_OBSERVATION_DATE_INDEX, $value);
    }

    // inclination
    public const string INCLINATION = 'inclination';
    protected const int INCLINATION_INDEX = 7;

    public ?string $inclination {
        get => $this->getData(self::INCLINATION_INDEX);
        set => $this->setData(self::INCLINATION_INDEX, $value);
    }

    // jupiter_tisserand_invariant
    public const string JUPITER_TISSERAND_INVARIANT = 'jupiter_tisserand_invariant';
    protected const int JUPITER_TISSERAND_INVARIANT_INDEX = 8;

    public ?string $jupiter_tisserand_invariant {
        get => $this->getData(self::JUPITER_TISSERAND_INVARIANT_INDEX);
        set => $this->setData(self::JUPITER_TISSERAND_INVARIANT_INDEX, $value);
    }

    // last_observation_date
    public const string LAST_OBSERVATION_DATE = 'last_observation_date';
    protected const int LAST_OBSERVATION_DATE_INDEX = 9;

    public ?string $last_observation_date {
        get => $this->getData(self::LAST_OBSERVATION_DATE_INDEX);
        set => $this->setData(self::LAST_OBSERVATION_DATE_INDEX, $value);
    }

    // mean_anomaly
    public const string MEAN_ANOMALY = 'mean_anomaly';
    protected const int MEAN_ANOMALY_INDEX = 10;

    public ?string $mean_anomaly {
        get => $this->getData(self::MEAN_ANOMALY_INDEX);
        set => $this->setData(self::MEAN_ANOMALY_INDEX, $value);
    }

    // mean_motion
    public const string MEAN_MOTION = 'mean_motion';
    protected const int MEAN_MOTION_INDEX = 11;

    public ?string $mean_motion {
        get => $this->getData(self::MEAN_MOTION_INDEX);
        set => $this->setData(self::MEAN_MOTION_INDEX, $value);
    }

    // minimum_orbit_intersection
    public const string MINIMUM_ORBIT_INTERSECTION = 'minimum_orbit_intersection';
    protected const int MINIMUM_ORBIT_INTERSECTION_INDEX = 12;

    public ?string $minimum_orbit_intersection {
        get => $this->getData(self::MINIMUM_ORBIT_INTERSECTION_INDEX);
        set => $this->setData(self::MINIMUM_ORBIT_INTERSECTION_INDEX, $value);
    }

    // observations_used
    public const string OBSERVATIONS_USED = 'observations_used';
    protected const int OBSERVATIONS_USED_INDEX = 13;

    public ?int $observations_used {
        get => $this->getData(self::OBSERVATIONS_USED_INDEX);
        set => $this->setData(self::OBSERVATIONS_USED_INDEX, $value);
    }

    // orbit_class
    #[PropertyTypeAttribute(OrbitClassTransfer::class)]
    public const string ORBIT_CLASS = 'orbit_class';
    protected const int ORBIT_CLASS_INDEX = 14;

    public ?OrbitClassTransfer $orbit_class {
        get => $this->getData(self::ORBIT_CLASS_INDEX);
        set => $this->setData(self::ORBIT_CLASS_INDEX, $value);
    }

    // orbit_determination_date
    public const string ORBIT_DETERMINATION_DATE = 'orbit_determination_date';
    protected const int ORBIT_DETERMINATION_DATE_INDEX = 15;

    public ?string $orbit_determination_date {
        get => $this->getData(self::ORBIT_DETERMINATION_DATE_INDEX);
        set => $this->setData(self::ORBIT_DETERMINATION_DATE_INDEX, $value);
    }

    // orbit_id
    public const string ORBIT_ID = 'orbit_id';
    protected const int ORBIT_ID_INDEX = 16;

    public ?string $orbit_id {
        get => $this->getData(self::ORBIT_ID_INDEX);
        set => $this->setData(self::ORBIT_ID_INDEX, $value);
    }

    // orbit_uncertainty
    public const string ORBIT_UNCERTAINTY = 'orbit_uncertainty';
    protected const int ORBIT_UNCERTAINTY_INDEX = 17;

    public ?string $orbit_uncertainty {
        get => $this->getData(self::ORBIT_UNCERTAINTY_INDEX);
        set => $this->setData(self::ORBIT_UNCERTAINTY_INDEX, $value);
    }

    // orbital_period
    public const string ORBITAL_PERIOD = 'orbital_period';
    protected const int ORBITAL_PERIOD_INDEX = 18;

    public ?string $orbital_period {
        get => $this->getData(self::ORBITAL_PERIOD_INDEX);
        set => $this->setData(self::ORBITAL_PERIOD_INDEX, $value);
    }

    // perihelion_argument
    public const string PERIHELION_ARGUMENT = 'perihelion_argument';
    protected const int PERIHELION_ARGUMENT_INDEX = 19;

    public ?string $perihelion_argument {
        get => $this->getData(self::PERIHELION_ARGUMENT_INDEX);
        set => $this->setData(self::PERIHELION_ARGUMENT_INDEX, $value);
    }

    // perihelion_distance
    public const string PERIHELION_DISTANCE = 'perihelion_distance';
    protected const int PERIHELION_DISTANCE_INDEX = 20;

    public ?string $perihelion_distance {
        get => $this->getData(self::PERIHELION_DISTANCE_INDEX);
        set => $this->setData(self::PERIHELION_DISTANCE_INDEX, $value);
    }

    // perihelion_time
    public const string PERIHELION_TIME = 'perihelion_time';
    protected const int PERIHELION_TIME_INDEX = 21;

    public ?string $perihelion_time {
        get => $this->getData(self::PERIHELION_TIME_INDEX);
        set => $this->setData(self::PERIHELION_TIME_INDEX, $value);
    }

    // semi_major_axis
    public const string SEMI_MAJOR_AXIS = 'semi_major_axis';
    protected const int SEMI_MAJOR_AXIS_INDEX = 22;

    public ?string $semi_major_axis {
        get => $this->getData(self::SEMI_MAJOR_AXIS_INDEX);
        set => $this->setData(self::SEMI_MAJOR_AXIS_INDEX, $value);
    }
}
