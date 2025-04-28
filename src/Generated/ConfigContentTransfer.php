<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /config/definition/transfer-generator.transfer.yml Definition file path.
 */
final class ConfigContentTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::DEFINITION_PATH => self::DEFINITION_PATH_DATA_NAME,
        self::RELATIVE_DEFINITION_PATH => self::RELATIVE_DEFINITION_PATH_DATA_NAME,
        self::TRANSFER_NAMESPACE => self::TRANSFER_NAMESPACE_DATA_NAME,
        self::TRANSFER_PATH => self::TRANSFER_PATH_DATA_NAME,
    ];

    // definitionPath
    public const string DEFINITION_PATH = 'definitionPath';
    protected const string DEFINITION_PATH_DATA_NAME = 'DEFINITION_PATH';
    protected const int DEFINITION_PATH_DATA_INDEX = 0;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_DATA_INDEX);
        set => $this->setData(self::DEFINITION_PATH_DATA_INDEX, $value);
    }

    // relativeDefinitionPath
    public const string RELATIVE_DEFINITION_PATH = 'relativeDefinitionPath';
    protected const string RELATIVE_DEFINITION_PATH_DATA_NAME = 'RELATIVE_DEFINITION_PATH';
    protected const int RELATIVE_DEFINITION_PATH_DATA_INDEX = 1;

    public string $relativeDefinitionPath {
        get => $this->getData(self::RELATIVE_DEFINITION_PATH_DATA_INDEX);
        set => $this->setData(self::RELATIVE_DEFINITION_PATH_DATA_INDEX, $value);
    }

    // transferNamespace
    public const string TRANSFER_NAMESPACE = 'transferNamespace';
    protected const string TRANSFER_NAMESPACE_DATA_NAME = 'TRANSFER_NAMESPACE';
    protected const int TRANSFER_NAMESPACE_DATA_INDEX = 2;

    public string $transferNamespace {
        get => $this->getData(self::TRANSFER_NAMESPACE_DATA_INDEX);
        set => $this->setData(self::TRANSFER_NAMESPACE_DATA_INDEX, $value);
    }

    // transferPath
    public const string TRANSFER_PATH = 'transferPath';
    protected const string TRANSFER_PATH_DATA_NAME = 'TRANSFER_PATH';
    protected const int TRANSFER_PATH_DATA_INDEX = 3;

    public string $transferPath {
        get => $this->getData(self::TRANSFER_PATH_DATA_INDEX);
        set => $this->setData(self::TRANSFER_PATH_DATA_INDEX, $value);
    }
}
