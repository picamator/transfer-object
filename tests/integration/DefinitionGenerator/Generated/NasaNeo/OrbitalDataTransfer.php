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
final class OrbitalDataTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 23;

    protected const array META_DATA = [
        self::APHELION_DISTANCE_PROP => self::APHELION_DISTANCE_INDEX,
        self::ASCENDING_NODE_LONGITUDE_PROP => self::ASCENDING_NODE_LONGITUDE_INDEX,
        self::DATA_ARC_IN_DAYS_PROP => self::DATA_ARC_IN_DAYS_INDEX,
        self::ECCENTRICITY_PROP => self::ECCENTRICITY_INDEX,
        self::EPOCH_OSCULATION_PROP => self::EPOCH_OSCULATION_INDEX,
        self::EQUINOX_PROP => self::EQUINOX_INDEX,
        self::FIRST_OBSERVATION_DATE_PROP => self::FIRST_OBSERVATION_DATE_INDEX,
        self::INCLINATION_PROP => self::INCLINATION_INDEX,
        self::JUPITER_TISSERAND_INVARIANT_PROP => self::JUPITER_TISSERAND_INVARIANT_INDEX,
        self::LAST_OBSERVATION_DATE_PROP => self::LAST_OBSERVATION_DATE_INDEX,
        self::MEAN_ANOMALY_PROP => self::MEAN_ANOMALY_INDEX,
        self::MEAN_MOTION_PROP => self::MEAN_MOTION_INDEX,
        self::MINIMUM_ORBIT_INTERSECTION_PROP => self::MINIMUM_ORBIT_INTERSECTION_INDEX,
        self::OBSERVATIONS_USED_PROP => self::OBSERVATIONS_USED_INDEX,
        self::ORBIT_CLASS_PROP => self::ORBIT_CLASS_INDEX,
        self::ORBIT_DETERMINATION_DATE_PROP => self::ORBIT_DETERMINATION_DATE_INDEX,
        self::ORBIT_ID_PROP => self::ORBIT_ID_INDEX,
        self::ORBIT_UNCERTAINTY_PROP => self::ORBIT_UNCERTAINTY_INDEX,
        self::ORBITAL_PERIOD_PROP => self::ORBITAL_PERIOD_INDEX,
        self::PERIHELION_ARGUMENT_PROP => self::PERIHELION_ARGUMENT_INDEX,
        self::PERIHELION_DISTANCE_PROP => self::PERIHELION_DISTANCE_INDEX,
        self::PERIHELION_TIME_PROP => self::PERIHELION_TIME_INDEX,
        self::SEMI_MAJOR_AXIS_PROP => self::SEMI_MAJOR_AXIS_INDEX,
    ];

    // aphelion_distance
    public const string APHELION_DISTANCE_PROP = 'aphelion_distance';
    private const int APHELION_DISTANCE_INDEX = 0;

    public ?string $aphelion_distance {
        get => $this->getData(self::APHELION_DISTANCE_INDEX);
        set => $this->setData(self::APHELION_DISTANCE_INDEX, $value);
    }

    // ascending_node_longitude
    public const string ASCENDING_NODE_LONGITUDE_PROP = 'ascending_node_longitude';
    private const int ASCENDING_NODE_LONGITUDE_INDEX = 1;

    public ?string $ascending_node_longitude {
        get => $this->getData(self::ASCENDING_NODE_LONGITUDE_INDEX);
        set => $this->setData(self::ASCENDING_NODE_LONGITUDE_INDEX, $value);
    }

    // data_arc_in_days
    public const string DATA_ARC_IN_DAYS_PROP = 'data_arc_in_days';
    private const int DATA_ARC_IN_DAYS_INDEX = 2;

    public ?int $data_arc_in_days {
        get => $this->getData(self::DATA_ARC_IN_DAYS_INDEX);
        set => $this->setData(self::DATA_ARC_IN_DAYS_INDEX, $value);
    }

    // eccentricity
    public const string ECCENTRICITY_PROP = 'eccentricity';
    private const int ECCENTRICITY_INDEX = 3;

    public ?string $eccentricity {
        get => $this->getData(self::ECCENTRICITY_INDEX);
        set => $this->setData(self::ECCENTRICITY_INDEX, $value);
    }

    // epoch_osculation
    public const string EPOCH_OSCULATION_PROP = 'epoch_osculation';
    private const int EPOCH_OSCULATION_INDEX = 4;

    public ?string $epoch_osculation {
        get => $this->getData(self::EPOCH_OSCULATION_INDEX);
        set => $this->setData(self::EPOCH_OSCULATION_INDEX, $value);
    }

    // equinox
    public const string EQUINOX_PROP = 'equinox';
    private const int EQUINOX_INDEX = 5;

    public ?string $equinox {
        get => $this->getData(self::EQUINOX_INDEX);
        set => $this->setData(self::EQUINOX_INDEX, $value);
    }

    // first_observation_date
    public const string FIRST_OBSERVATION_DATE_PROP = 'first_observation_date';
    private const int FIRST_OBSERVATION_DATE_INDEX = 6;

    public ?string $first_observation_date {
        get => $this->getData(self::FIRST_OBSERVATION_DATE_INDEX);
        set => $this->setData(self::FIRST_OBSERVATION_DATE_INDEX, $value);
    }

    // inclination
    public const string INCLINATION_PROP = 'inclination';
    private const int INCLINATION_INDEX = 7;

    public ?string $inclination {
        get => $this->getData(self::INCLINATION_INDEX);
        set => $this->setData(self::INCLINATION_INDEX, $value);
    }

    // jupiter_tisserand_invariant
    public const string JUPITER_TISSERAND_INVARIANT_PROP = 'jupiter_tisserand_invariant';
    private const int JUPITER_TISSERAND_INVARIANT_INDEX = 8;

    public ?string $jupiter_tisserand_invariant {
        get => $this->getData(self::JUPITER_TISSERAND_INVARIANT_INDEX);
        set => $this->setData(self::JUPITER_TISSERAND_INVARIANT_INDEX, $value);
    }

    // last_observation_date
    public const string LAST_OBSERVATION_DATE_PROP = 'last_observation_date';
    private const int LAST_OBSERVATION_DATE_INDEX = 9;

    public ?string $last_observation_date {
        get => $this->getData(self::LAST_OBSERVATION_DATE_INDEX);
        set => $this->setData(self::LAST_OBSERVATION_DATE_INDEX, $value);
    }

    // mean_anomaly
    public const string MEAN_ANOMALY_PROP = 'mean_anomaly';
    private const int MEAN_ANOMALY_INDEX = 10;

    public ?string $mean_anomaly {
        get => $this->getData(self::MEAN_ANOMALY_INDEX);
        set => $this->setData(self::MEAN_ANOMALY_INDEX, $value);
    }

    // mean_motion
    public const string MEAN_MOTION_PROP = 'mean_motion';
    private const int MEAN_MOTION_INDEX = 11;

    public ?string $mean_motion {
        get => $this->getData(self::MEAN_MOTION_INDEX);
        set => $this->setData(self::MEAN_MOTION_INDEX, $value);
    }

    // minimum_orbit_intersection
    public const string MINIMUM_ORBIT_INTERSECTION_PROP = 'minimum_orbit_intersection';
    private const int MINIMUM_ORBIT_INTERSECTION_INDEX = 12;

    public ?string $minimum_orbit_intersection {
        get => $this->getData(self::MINIMUM_ORBIT_INTERSECTION_INDEX);
        set => $this->setData(self::MINIMUM_ORBIT_INTERSECTION_INDEX, $value);
    }

    // observations_used
    public const string OBSERVATIONS_USED_PROP = 'observations_used';
    private const int OBSERVATIONS_USED_INDEX = 13;

    public ?int $observations_used {
        get => $this->getData(self::OBSERVATIONS_USED_INDEX);
        set => $this->setData(self::OBSERVATIONS_USED_INDEX, $value);
    }

    // orbit_class
    #[TransferTransformerAttribute(OrbitClassTransfer::class)]
    public const string ORBIT_CLASS_PROP = 'orbit_class';
    private const int ORBIT_CLASS_INDEX = 14;

    public ?OrbitClassTransfer $orbit_class {
        get => $this->getData(self::ORBIT_CLASS_INDEX);
        set => $this->setData(self::ORBIT_CLASS_INDEX, $value);
    }

    // orbit_determination_date
    public const string ORBIT_DETERMINATION_DATE_PROP = 'orbit_determination_date';
    private const int ORBIT_DETERMINATION_DATE_INDEX = 15;

    public ?string $orbit_determination_date {
        get => $this->getData(self::ORBIT_DETERMINATION_DATE_INDEX);
        set => $this->setData(self::ORBIT_DETERMINATION_DATE_INDEX, $value);
    }

    // orbit_id
    public const string ORBIT_ID_PROP = 'orbit_id';
    private const int ORBIT_ID_INDEX = 16;

    public ?string $orbit_id {
        get => $this->getData(self::ORBIT_ID_INDEX);
        set => $this->setData(self::ORBIT_ID_INDEX, $value);
    }

    // orbit_uncertainty
    public const string ORBIT_UNCERTAINTY_PROP = 'orbit_uncertainty';
    private const int ORBIT_UNCERTAINTY_INDEX = 17;

    public ?string $orbit_uncertainty {
        get => $this->getData(self::ORBIT_UNCERTAINTY_INDEX);
        set => $this->setData(self::ORBIT_UNCERTAINTY_INDEX, $value);
    }

    // orbital_period
    public const string ORBITAL_PERIOD_PROP = 'orbital_period';
    private const int ORBITAL_PERIOD_INDEX = 18;

    public ?string $orbital_period {
        get => $this->getData(self::ORBITAL_PERIOD_INDEX);
        set => $this->setData(self::ORBITAL_PERIOD_INDEX, $value);
    }

    // perihelion_argument
    public const string PERIHELION_ARGUMENT_PROP = 'perihelion_argument';
    private const int PERIHELION_ARGUMENT_INDEX = 19;

    public ?string $perihelion_argument {
        get => $this->getData(self::PERIHELION_ARGUMENT_INDEX);
        set => $this->setData(self::PERIHELION_ARGUMENT_INDEX, $value);
    }

    // perihelion_distance
    public const string PERIHELION_DISTANCE_PROP = 'perihelion_distance';
    private const int PERIHELION_DISTANCE_INDEX = 20;

    public ?string $perihelion_distance {
        get => $this->getData(self::PERIHELION_DISTANCE_INDEX);
        set => $this->setData(self::PERIHELION_DISTANCE_INDEX, $value);
    }

    // perihelion_time
    public const string PERIHELION_TIME_PROP = 'perihelion_time';
    private const int PERIHELION_TIME_INDEX = 21;

    public ?string $perihelion_time {
        get => $this->getData(self::PERIHELION_TIME_INDEX);
        set => $this->setData(self::PERIHELION_TIME_INDEX, $value);
    }

    // semi_major_axis
    public const string SEMI_MAJOR_AXIS_PROP = 'semi_major_axis';
    private const int SEMI_MAJOR_AXIS_INDEX = 22;

    public ?string $semi_major_axis {
        get => $this->getData(self::SEMI_MAJOR_AXIS_INDEX);
        set => $this->setData(self::SEMI_MAJOR_AXIS_INDEX, $value);
    }
}
