<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Destatis;

use ArrayObject;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\Initiator\CollectionInitiatorAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\CollectionTransformerAttribute;
use Picamator\TransferObject\Transfer\Attribute\Transformer\TransferTransformerAttribute;

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
        self::COPYRIGHT_INDEX => self::COPYRIGHT,
        self::CUBES_INDEX => self::CUBES,
        self::IDENT_INDEX => self::IDENT,
        self::PARAMETER_INDEX => self::PARAMETER,
        self::STATISTICS_INDEX => self::STATISTICS,
        self::STATUS_INDEX => self::STATUS,
        self::TABLES_INDEX => self::TABLES,
        self::TIMESERIES_INDEX => self::TIMESERIES,
        self::VARIABLES_INDEX => self::VARIABLES,
    ];

    // Copyright
    public const string COPYRIGHT = 'Copyright';
    private const int COPYRIGHT_INDEX = 0;

    public ?string $Copyright {
        get => $this->getData(self::COPYRIGHT_INDEX);
        set => $this->setData(self::COPYRIGHT_INDEX, $value);
    }

    // Cubes
    public const string CUBES = 'Cubes';
    private const int CUBES_INDEX = 1;

    public ?string $Cubes {
        get => $this->getData(self::CUBES_INDEX);
        set => $this->setData(self::CUBES_INDEX, $value);
    }

    // Ident
    #[TransferTransformerAttribute(IdentTransfer::class)]
    public const string IDENT = 'Ident';
    private const int IDENT_INDEX = 2;

    public ?IdentTransfer $Ident {
        get => $this->getData(self::IDENT_INDEX);
        set => $this->setData(self::IDENT_INDEX, $value);
    }

    // Parameter
    #[TransferTransformerAttribute(ParameterTransfer::class)]
    public const string PARAMETER = 'Parameter';
    private const int PARAMETER_INDEX = 3;

    public ?ParameterTransfer $Parameter {
        get => $this->getData(self::PARAMETER_INDEX);
        set => $this->setData(self::PARAMETER_INDEX, $value);
    }

    // Statistics
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(StatisticsTransfer::class)]
    public const string STATISTICS = 'Statistics';
    private const int STATISTICS_INDEX = 4;

    /** @var \ArrayObject<int,StatisticsTransfer> */
    public ArrayObject $Statistics {
        get => $this->getData(self::STATISTICS_INDEX);
        set => $this->setData(self::STATISTICS_INDEX, $value);
    }

    // Status
    #[TransferTransformerAttribute(StatusTransfer::class)]
    public const string STATUS = 'Status';
    private const int STATUS_INDEX = 5;

    public ?StatusTransfer $Status {
        get => $this->getData(self::STATUS_INDEX);
        set => $this->setData(self::STATUS_INDEX, $value);
    }

    // Tables
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(TablesTransfer::class)]
    public const string TABLES = 'Tables';
    private const int TABLES_INDEX = 6;

    /** @var \ArrayObject<int,TablesTransfer> */
    public ArrayObject $Tables {
        get => $this->getData(self::TABLES_INDEX);
        set => $this->setData(self::TABLES_INDEX, $value);
    }

    // Timeseries
    public const string TIMESERIES = 'Timeseries';
    private const int TIMESERIES_INDEX = 7;

    public ?string $Timeseries {
        get => $this->getData(self::TIMESERIES_INDEX);
        set => $this->setData(self::TIMESERIES_INDEX, $value);
    }

    // Variables
    #[CollectionInitiatorAttribute]
    #[CollectionTransformerAttribute(VariablesTransfer::class)]
    public const string VARIABLES = 'Variables';
    private const int VARIABLES_INDEX = 8;

    /** @var \ArrayObject<int,VariablesTransfer> */
    public ArrayObject $Variables {
        get => $this->getData(self::VARIABLES_INDEX);
        set => $this->setData(self::VARIABLES_INDEX, $value);
    }
}
