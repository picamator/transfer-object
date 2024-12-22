<?php declare(strict_types = 1);

namespace Picamator\TransferGenerator\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is generated based on definition.
 * - In order to modify file please change definition and run generator.
 */
final class ConfigTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
        self::TRANSFER_NAMESPACE => self::TRANSFER_NAMESPACE_DATA_NAME,
        self::TRANSFER_PATH => self::TRANSFER_PATH_DATA_NAME,
    ];

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    protected const string DEFINITION_PATH_DATA_NAME = 'DEFINITION_PATH';
    protected const int DEFINITION_PATH_DATA_INDEX = 0;

    public ?string $definitionPath {
        get => $this->_data[self::DEFINITION_PATH_DATA_INDEX];
        set => $this->_data[self::DEFINITION_PATH_DATA_INDEX] = $value;
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
