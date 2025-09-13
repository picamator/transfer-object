<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Destatis;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\CollectionPropertyTypeAttribute;
use Picamator\TransferObject\Transfer\Attribute\PropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/genesis-destatis-find/definition/destatis.transfer.yml Definition file path.
 */
final class DestatisTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 9;

    protected const array META_DATA = [
        self::COPYRIGHT => self::COPYRIGHT_DATA_NAME,
        self::CUBES => self::CUBES_DATA_NAME,
        self::IDENT => self::IDENT_DATA_NAME,
        self::PARAMETER => self::PARAMETER_DATA_NAME,
        self::STATISTICS => self::STATISTICS_DATA_NAME,
        self::STATUS => self::STATUS_DATA_NAME,
        self::TABLES => self::TABLES_DATA_NAME,
        self::TIMESERIES => self::TIMESERIES_DATA_NAME,
        self::VARIABLES => self::VARIABLES_DATA_NAME,
    ];

    // Copyright
    public const string COPYRIGHT = 'Copyright';
    protected const string COPYRIGHT_DATA_NAME = 'COPYRIGHT';
    protected const int COPYRIGHT_DATA_INDEX = 0;

    public ?string $Copyright {
        get => $this->getData(self::COPYRIGHT_DATA_INDEX);
        set => $this->setData(self::COPYRIGHT_DATA_INDEX, $value);
    }

    // Cubes
    public const string CUBES = 'Cubes';
    protected const string CUBES_DATA_NAME = 'CUBES';
    protected const int CUBES_DATA_INDEX = 1;

    public ?string $Cubes {
        get => $this->getData(self::CUBES_DATA_INDEX);
        set => $this->setData(self::CUBES_DATA_INDEX, $value);
    }

    // Ident
    #[PropertyTypeAttribute(IdentTransfer::class)]
    public const string IDENT = 'Ident';
    protected const string IDENT_DATA_NAME = 'IDENT';
    protected const int IDENT_DATA_INDEX = 2;

    public ?IdentTransfer $Ident {
        get => $this->getData(self::IDENT_DATA_INDEX);
        set => $this->setData(self::IDENT_DATA_INDEX, $value);
    }

    // Parameter
    #[PropertyTypeAttribute(ParameterTransfer::class)]
    public const string PARAMETER = 'Parameter';
    protected const string PARAMETER_DATA_NAME = 'PARAMETER';
    protected const int PARAMETER_DATA_INDEX = 3;

    public ?ParameterTransfer $Parameter {
        get => $this->getData(self::PARAMETER_DATA_INDEX);
        set => $this->setData(self::PARAMETER_DATA_INDEX, $value);
    }

    // Statistics
    #[CollectionPropertyTypeAttribute(StatisticsTransfer::class)]
    public const string STATISTICS = 'Statistics';
    protected const string STATISTICS_DATA_NAME = 'STATISTICS';
    protected const int STATISTICS_DATA_INDEX = 4;

    /** @var \ArrayObject<int,StatisticsTransfer> */
    public ArrayObject $Statistics {
        get => $this->getData(self::STATISTICS_DATA_INDEX);
        set => $this->setData(self::STATISTICS_DATA_INDEX, $value);
    }

    // Status
    #[PropertyTypeAttribute(StatusTransfer::class)]
    public const string STATUS = 'Status';
    protected const string STATUS_DATA_NAME = 'STATUS';
    protected const int STATUS_DATA_INDEX = 5;

    public ?StatusTransfer $Status {
        get => $this->getData(self::STATUS_DATA_INDEX);
        set => $this->setData(self::STATUS_DATA_INDEX, $value);
    }

    // Tables
    #[CollectionPropertyTypeAttribute(TablesTransfer::class)]
    public const string TABLES = 'Tables';
    protected const string TABLES_DATA_NAME = 'TABLES';
    protected const int TABLES_DATA_INDEX = 6;

    /** @var \ArrayObject<int,TablesTransfer> */
    public ArrayObject $Tables {
        get => $this->getData(self::TABLES_DATA_INDEX);
        set => $this->setData(self::TABLES_DATA_INDEX, $value);
    }

    // Timeseries
    public const string TIMESERIES = 'Timeseries';
    protected const string TIMESERIES_DATA_NAME = 'TIMESERIES';
    protected const int TIMESERIES_DATA_INDEX = 7;

    public ?string $Timeseries {
        get => $this->getData(self::TIMESERIES_DATA_INDEX);
        set => $this->setData(self::TIMESERIES_DATA_INDEX, $value);
    }

    // Variables
    #[CollectionPropertyTypeAttribute(VariablesTransfer::class)]
    public const string VARIABLES = 'Variables';
    protected const string VARIABLES_DATA_NAME = 'VARIABLES';
    protected const int VARIABLES_DATA_INDEX = 8;

    /** @var \ArrayObject<int,VariablesTransfer> */
    public ArrayObject $Variables {
        get => $this->getData(self::VARIABLES_DATA_INDEX);
        set => $this->setData(self::VARIABLES_DATA_INDEX, $value);
    }
}
