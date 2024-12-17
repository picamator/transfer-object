<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class HelperTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::TRANSFER_DATA => self::TRANSFER_DATA_DATA_NAME,
        self::TRANSFER_NAMESPACE => self::TRANSFER_NAMESPACE_DATA_NAME,
        self::TRANSFER_PATH => self::TRANSFER_PATH_DATA_NAME,
    ];

    // transferData
    public const string TRANSFER_DATA = 'transferData';
    protected const string TRANSFER_DATA_DATA_NAME = 'TRANSFER_DATA';
    protected const int TRANSFER_DATA_DATA_INDEX = 0;

    /** @var iterable<mixed> */
    public ?iterable $transferData {
        get => $this->_data[self::TRANSFER_DATA_DATA_INDEX];
        set => $this->_data[self::TRANSFER_DATA_DATA_INDEX] = $value;
    }

    // transferNamespace
    public const string TRANSFER_NAMESPACE = 'transferNamespace';
    protected const string TRANSFER_NAMESPACE_DATA_NAME = 'TRANSFER_NAMESPACE';
    protected const int TRANSFER_NAMESPACE_DATA_INDEX = 1;

    public ?string $transferNamespace {
        get => $this->_data[self::TRANSFER_NAMESPACE_DATA_INDEX];
        set => $this->_data[self::TRANSFER_NAMESPACE_DATA_INDEX] = $value;
    }

    // transferPath
    public const string TRANSFER_PATH = 'transferPath';
    protected const string TRANSFER_PATH_DATA_NAME = 'TRANSFER_PATH';
    protected const int TRANSFER_PATH_DATA_INDEX = 2;

    public ?string $transferPath {
        get => $this->_data[self::TRANSFER_PATH_DATA_INDEX];
        set => $this->_data[self::TRANSFER_PATH_DATA_INDEX] = $value;
    }
}
