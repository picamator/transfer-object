<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\NasaNeo;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\ArrayObjectInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
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
final class AsteroidTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 12;

    protected const array META_DATA = [
        self::ABSOLUTE_MAGNITUDE_H_PROP => self::ABSOLUTE_MAGNITUDE_H_INDEX,
        self::CLOSE_APPROACH_DATA_PROP => self::CLOSE_APPROACH_DATA_INDEX,
        self::DESIGNATION_PROP => self::DESIGNATION_INDEX,
        self::ESTIMATED_DIAMETER_PROP => self::ESTIMATED_DIAMETER_INDEX,
        self::ID_PROP => self::ID_INDEX,
        self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_PROP => self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_INDEX,
        self::IS_SENTRY_OBJECT_PROP => self::IS_SENTRY_OBJECT_INDEX,
        self::LINKS_PROP => self::LINKS_INDEX,
        self::NAME_PROP => self::NAME_INDEX,
        self::NASA_JPL_URL_PROP => self::NASA_JPL_URL_INDEX,
        self::NEO_REFERENCE_ID_PROP => self::NEO_REFERENCE_ID_INDEX,
        self::ORBITAL_DATA_PROP => self::ORBITAL_DATA_INDEX,
    ];

    protected const array META_INITIATORS = [
        self::CLOSE_APPROACH_DATA_PROP => 'CLOSE_APPROACH_DATA_PROP',
    ];

    protected const array META_TRANSFORMERS = [
        self::CLOSE_APPROACH_DATA_PROP => 'CLOSE_APPROACH_DATA_PROP',
        self::ESTIMATED_DIAMETER_PROP => 'ESTIMATED_DIAMETER_PROP',
        self::LINKS_PROP => 'LINKS_PROP',
        self::ORBITAL_DATA_PROP => 'ORBITAL_DATA_PROP',
    ];

    // absolute_magnitude_h
    public const string ABSOLUTE_MAGNITUDE_H_PROP = 'absolute_magnitude_h';
    private const int ABSOLUTE_MAGNITUDE_H_INDEX = 0;

    public ?float $absolute_magnitude_h {
        get => $this->getData(self::ABSOLUTE_MAGNITUDE_H_INDEX);
        set {
            $this->setData(self::ABSOLUTE_MAGNITUDE_H_INDEX, $value);
        }
    }

    // close_approach_data
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(CloseApproachDataTransfer::class)]
    public const string CLOSE_APPROACH_DATA_PROP = 'close_approach_data';
    private const int CLOSE_APPROACH_DATA_INDEX = 1;

    /** @var \ArrayObject<int,CloseApproachDataTransfer> */
    public ArrayObject $close_approach_data {
        get => $this->getData(self::CLOSE_APPROACH_DATA_INDEX);
        set {
            $this->setData(self::CLOSE_APPROACH_DATA_INDEX, $value);
        }
    }

    // designation
    public const string DESIGNATION_PROP = 'designation';
    private const int DESIGNATION_INDEX = 2;

    public ?string $designation {
        get => $this->getData(self::DESIGNATION_INDEX);
        set {
            $this->setData(self::DESIGNATION_INDEX, $value);
        }
    }

    // estimated_diameter
    #[TransferTransformerAttribute(EstimatedDiameterTransfer::class)]
    public const string ESTIMATED_DIAMETER_PROP = 'estimated_diameter';
    private const int ESTIMATED_DIAMETER_INDEX = 3;

    public ?EstimatedDiameterTransfer $estimated_diameter {
        get => $this->getData(self::ESTIMATED_DIAMETER_INDEX);
        set {
            $this->setData(self::ESTIMATED_DIAMETER_INDEX, $value);
        }
    }

    // id
    public const string ID_PROP = 'id';
    private const int ID_INDEX = 4;

    public ?string $id {
        get => $this->getData(self::ID_INDEX);
        set {
            $this->setData(self::ID_INDEX, $value);
        }
    }

    // is_potentially_hazardous_asteroid
    public const string IS_POTENTIALLY_HAZARDOUS_ASTEROID_PROP = 'is_potentially_hazardous_asteroid';
    private const int IS_POTENTIALLY_HAZARDOUS_ASTEROID_INDEX = 5;

    public ?bool $is_potentially_hazardous_asteroid {
        get => $this->getData(self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_INDEX);
        set {
            $this->setData(self::IS_POTENTIALLY_HAZARDOUS_ASTEROID_INDEX, $value);
        }
    }

    // is_sentry_object
    public const string IS_SENTRY_OBJECT_PROP = 'is_sentry_object';
    private const int IS_SENTRY_OBJECT_INDEX = 6;

    public ?bool $is_sentry_object {
        get => $this->getData(self::IS_SENTRY_OBJECT_INDEX);
        set {
            $this->setData(self::IS_SENTRY_OBJECT_INDEX, $value);
        }
    }

    // links
    #[TransferTransformerAttribute(LinksTransfer::class)]
    public const string LINKS_PROP = 'links';
    private const int LINKS_INDEX = 7;

    public ?LinksTransfer $links {
        get => $this->getData(self::LINKS_INDEX);
        set {
            $this->setData(self::LINKS_INDEX, $value);
        }
    }

    // name
    public const string NAME_PROP = 'name';
    private const int NAME_INDEX = 8;

    public ?string $name {
        get => $this->getData(self::NAME_INDEX);
        set {
            $this->setData(self::NAME_INDEX, $value);
        }
    }

    // nasa_jpl_url
    public const string NASA_JPL_URL_PROP = 'nasa_jpl_url';
    private const int NASA_JPL_URL_INDEX = 9;

    public ?string $nasa_jpl_url {
        get => $this->getData(self::NASA_JPL_URL_INDEX);
        set {
            $this->setData(self::NASA_JPL_URL_INDEX, $value);
        }
    }

    // neo_reference_id
    public const string NEO_REFERENCE_ID_PROP = 'neo_reference_id';
    private const int NEO_REFERENCE_ID_INDEX = 10;

    public ?string $neo_reference_id {
        get => $this->getData(self::NEO_REFERENCE_ID_INDEX);
        set {
            $this->setData(self::NEO_REFERENCE_ID_INDEX, $value);
        }
    }

    // orbital_data
    #[TransferTransformerAttribute(OrbitalDataTransfer::class)]
    public const string ORBITAL_DATA_PROP = 'orbital_data';
    private const int ORBITAL_DATA_INDEX = 11;

    public ?OrbitalDataTransfer $orbital_data {
        get => $this->getData(self::ORBITAL_DATA_INDEX);
        set {
            $this->setData(self::ORBITAL_DATA_INDEX, $value);
        }
    }
}
