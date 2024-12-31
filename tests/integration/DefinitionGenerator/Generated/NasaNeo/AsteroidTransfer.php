<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Class generated from a definition file.
 *
 * Specification:
 * - This class is automatically generated based on a definition file.
 * - To modify this class, update the definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 */
final class AsteroidTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 12;

    protected const array META_DATA = [
        self::ABSOLUTE_MAGNITUDE_H => self::ABSOLUTE_MAGNITUDE_H_DATA_NAME,
        self::CLOSE_APPROACH_DATA => self::CLOSE_APPROACH_DATA_DATA_NAME,
        self::DESIGNATION => self::DESIGNATION_DATA_NAME,
        self::ESTIMATED_DIAMETER => self::ESTIMATED_DIAMETER_DATA_NAME,
        self::ID => self::ID_DATA_NAME,
        self::IS_POTENTIALLY_HAZARDOUS_ASTEROID => self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_DATA_NAME,
        self::IS_SENTRY_OBJECT => self::IS_SENTRY_OBJECT_DATA_NAME,
        self::LINKS => self::LINKS_DATA_NAME,
        self::NAME => self::NAME_DATA_NAME,
        self::NASA_JPL_URL => self::NASA_JPL_URL_DATA_NAME,
        self::NEO_REFERENCE_ID => self::NEO_REFERENCE_ID_DATA_NAME,
        self::ORBITAL_DATA => self::ORBITAL_DATA_DATA_NAME,
    ];

    // absolute_magnitude_h
    public const string ABSOLUTE_MAGNITUDE_H = 'absolute_magnitude_h';
    protected const string ABSOLUTE_MAGNITUDE_H_DATA_NAME = 'ABSOLUTE_MAGNITUDE_H';
    protected const int ABSOLUTE_MAGNITUDE_H_DATA_INDEX = 0;

    public ?float $absolute_magnitude_h {
        get => $this->getData(self::ABSOLUTE_MAGNITUDE_H_DATA_INDEX);
        set => $this->setData(self::ABSOLUTE_MAGNITUDE_H_DATA_INDEX, $value);
    }

    // close_approach_data
    #[CollectionPropertyTypeAttribute(CloseApproachDataTransfer::class)]
    public const string CLOSE_APPROACH_DATA = 'close_approach_data';
    protected const string CLOSE_APPROACH_DATA_DATA_NAME = 'CLOSE_APPROACH_DATA';
    protected const int CLOSE_APPROACH_DATA_DATA_INDEX = 1;

    /** @var \ArrayObject<int,CloseApproachDataTransfer> */
    public ArrayObject $close_approach_data {
        get => $this->getData(self::CLOSE_APPROACH_DATA_DATA_INDEX);
        set => $this->setData(self::CLOSE_APPROACH_DATA_DATA_INDEX, $value);
    }

    // designation
    public const string DESIGNATION = 'designation';
    protected const string DESIGNATION_DATA_NAME = 'DESIGNATION';
    protected const int DESIGNATION_DATA_INDEX = 2;

    public ?string $designation {
        get => $this->getData(self::DESIGNATION_DATA_INDEX);
        set => $this->setData(self::DESIGNATION_DATA_INDEX, $value);
    }

    // estimated_diameter
    #[PropertyTypeAttribute(EstimatedDiameterTransfer::class)]
    public const string ESTIMATED_DIAMETER = 'estimated_diameter';
    protected const string ESTIMATED_DIAMETER_DATA_NAME = 'ESTIMATED_DIAMETER';
    protected const int ESTIMATED_DIAMETER_DATA_INDEX = 3;

    public ?EstimatedDiameterTransfer $estimated_diameter {
        get => $this->getData(self::ESTIMATED_DIAMETER_DATA_INDEX);
        set => $this->setData(self::ESTIMATED_DIAMETER_DATA_INDEX, $value);
    }

    // id
    public const string ID = 'id';
    protected const string ID_DATA_NAME = 'ID';
    protected const int ID_DATA_INDEX = 4;

    public ?string $id {
        get => $this->getData(self::ID_DATA_INDEX);
        set => $this->setData(self::ID_DATA_INDEX, $value);
    }

    // is_potentially_hazardous_asteroid
    public const string IS_POTENTIALLY_HAZARDOUS_ASTEROID = 'is_potentially_hazardous_asteroid';
    protected const string IS_POTENTIALLY_HAZARDOUS_ASTEROID_DATA_NAME = 'IS_POTENTIALLY_HAZARDOUS_ASTEROID';
    protected const int IS_POTENTIALLY_HAZARDOUS_ASTEROID_DATA_INDEX = 5;

    public ?bool $is_potentially_hazardous_asteroid {
        get => $this->getData(self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_DATA_INDEX);
        set => $this->setData(self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_DATA_INDEX, $value);
    }

    // is_sentry_object
    public const string IS_SENTRY_OBJECT = 'is_sentry_object';
    protected const string IS_SENTRY_OBJECT_DATA_NAME = 'IS_SENTRY_OBJECT';
    protected const int IS_SENTRY_OBJECT_DATA_INDEX = 6;

    public ?bool $is_sentry_object {
        get => $this->getData(self::IS_SENTRY_OBJECT_DATA_INDEX);
        set => $this->setData(self::IS_SENTRY_OBJECT_DATA_INDEX, $value);
    }

    // links
    #[PropertyTypeAttribute(LinksTransfer::class)]
    public const string LINKS = 'links';
    protected const string LINKS_DATA_NAME = 'LINKS';
    protected const int LINKS_DATA_INDEX = 7;

    public ?LinksTransfer $links {
        get => $this->getData(self::LINKS_DATA_INDEX);
        set => $this->setData(self::LINKS_DATA_INDEX, $value);
    }

    // name
    public const string NAME = 'name';
    protected const string NAME_DATA_NAME = 'NAME';
    protected const int NAME_DATA_INDEX = 8;

    public ?string $name {
        get => $this->getData(self::NAME_DATA_INDEX);
        set => $this->setData(self::NAME_DATA_INDEX, $value);
    }

    // nasa_jpl_url
    public const string NASA_JPL_URL = 'nasa_jpl_url';
    protected const string NASA_JPL_URL_DATA_NAME = 'NASA_JPL_URL';
    protected const int NASA_JPL_URL_DATA_INDEX = 9;

    public ?string $nasa_jpl_url {
        get => $this->getData(self::NASA_JPL_URL_DATA_INDEX);
        set => $this->setData(self::NASA_JPL_URL_DATA_INDEX, $value);
    }

    // neo_reference_id
    public const string NEO_REFERENCE_ID = 'neo_reference_id';
    protected const string NEO_REFERENCE_ID_DATA_NAME = 'NEO_REFERENCE_ID';
    protected const int NEO_REFERENCE_ID_DATA_INDEX = 10;

    public ?string $neo_reference_id {
        get => $this->getData(self::NEO_REFERENCE_ID_DATA_INDEX);
        set => $this->setData(self::NEO_REFERENCE_ID_DATA_INDEX, $value);
    }

    // orbital_data
    #[PropertyTypeAttribute(OrbitalDataTransfer::class)]
    public const string ORBITAL_DATA = 'orbital_data';
    protected const string ORBITAL_DATA_DATA_NAME = 'ORBITAL_DATA';
    protected const int ORBITAL_DATA_DATA_INDEX = 11;

    public ?OrbitalDataTransfer $orbital_data {
        get => $this->getData(self::ORBITAL_DATA_DATA_INDEX);
        set => $this->setData(self::ORBITAL_DATA_DATA_INDEX, $value);
    }
}
