<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Destatis;

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
 * @see /tests/integration/DefinitionGenerator/data/config/genesis-destatis-find/definition/destatis.transfer.yml Definition file path.
 */
final class DestatisTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 9;

    protected const array META_DATA = [
        self::COPYRIGHT_PROP => self::COPYRIGHT_INDEX,
        self::CUBES_PROP => self::CUBES_INDEX,
        self::IDENT_PROP => self::IDENT_INDEX,
        self::PARAMETER_PROP => self::PARAMETER_INDEX,
        self::STATISTICS_PROP => self::STATISTICS_INDEX,
        self::STATUS_PROP => self::STATUS_INDEX,
        self::TABLES_PROP => self::TABLES_INDEX,
        self::TIMESERIES_PROP => self::TIMESERIES_INDEX,
        self::VARIABLES_PROP => self::VARIABLES_INDEX,
    ];

    // Copyright
    public const string COPYRIGHT_PROP = 'Copyright';
    private const int COPYRIGHT_INDEX = 0;

    public ?string $Copyright {
        get => $this->getData(self::COPYRIGHT_INDEX);
        set {
            $this->setData(self::COPYRIGHT_INDEX, $value);
        }
    }

    // Cubes
    public const string CUBES_PROP = 'Cubes';
    private const int CUBES_INDEX = 1;

    public ?string $Cubes {
        get => $this->getData(self::CUBES_INDEX);
        set {
            $this->setData(self::CUBES_INDEX, $value);
        }
    }

    // Ident
    #[TransferTransformerAttribute(IdentTransfer::class)]
    public const string IDENT_PROP = 'Ident';
    private const int IDENT_INDEX = 2;

    public ?IdentTransfer $Ident {
        get => $this->getData(self::IDENT_INDEX);
        set {
            $this->setData(self::IDENT_INDEX, $value);
        }
    }

    // Parameter
    #[TransferTransformerAttribute(ParameterTransfer::class)]
    public const string PARAMETER_PROP = 'Parameter';
    private const int PARAMETER_INDEX = 3;

    public ?ParameterTransfer $Parameter {
        get => $this->getData(self::PARAMETER_INDEX);
        set {
            $this->setData(self::PARAMETER_INDEX, $value);
        }
    }

    // Statistics
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(StatisticsTransfer::class)]
    public const string STATISTICS_PROP = 'Statistics';
    private const int STATISTICS_INDEX = 4;

    /** @var \ArrayObject<int,StatisticsTransfer> */
    public ArrayObject $Statistics {
        get => $this->getData(self::STATISTICS_INDEX);
        set {
            $this->setData(self::STATISTICS_INDEX, $value);
        }
    }

    // Status
    #[TransferTransformerAttribute(StatusTransfer::class)]
    public const string STATUS_PROP = 'Status';
    private const int STATUS_INDEX = 5;

    public ?StatusTransfer $Status {
        get => $this->getData(self::STATUS_INDEX);
        set {
            $this->setData(self::STATUS_INDEX, $value);
        }
    }

    // Tables
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(TablesTransfer::class)]
    public const string TABLES_PROP = 'Tables';
    private const int TABLES_INDEX = 6;

    /** @var \ArrayObject<int,TablesTransfer> */
    public ArrayObject $Tables {
        get => $this->getData(self::TABLES_INDEX);
        set {
            $this->setData(self::TABLES_INDEX, $value);
        }
    }

    // Timeseries
    public const string TIMESERIES_PROP = 'Timeseries';
    private const int TIMESERIES_INDEX = 7;

    public ?string $Timeseries {
        get => $this->getData(self::TIMESERIES_INDEX);
        set {
            $this->setData(self::TIMESERIES_INDEX, $value);
        }
    }

    // Variables
    #[ArrayObjectInitiatorAttribute]
    #[CollectionTransformerAttribute(VariablesTransfer::class)]
    public const string VARIABLES_PROP = 'Variables';
    private const int VARIABLES_INDEX = 8;

    /** @var \ArrayObject<int,VariablesTransfer> */
    public ArrayObject $Variables {
        get => $this->getData(self::VARIABLES_INDEX);
        set {
            $this->setData(self::VARIABLES_INDEX, $value);
        }
    }
}
