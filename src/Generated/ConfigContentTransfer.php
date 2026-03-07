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
    protected const int META_DATA_SIZE = 7;

    protected const array META_DATA = [
        self::DEFINITION_PATH_PROP => self::DEFINITION_PATH_INDEX,
        self::HASH_FILE_NAME_PROP => self::HASH_FILE_NAME_INDEX,
        self::IS_CACHE_ENABLED_PROP => self::IS_CACHE_ENABLED_INDEX,
        self::RELATIVE_DEFINITION_PATH_PROP => self::RELATIVE_DEFINITION_PATH_INDEX,
        self::TRANSFER_NAMESPACE_PROP => self::TRANSFER_NAMESPACE_INDEX,
        self::TRANSFER_PATH_PROP => self::TRANSFER_PATH_INDEX,
        self::UUID_PROP => self::UUID_INDEX,
    ];

    // definitionPath
    public const string DEFINITION_PATH_PROP = 'definitionPath';
    private const int DEFINITION_PATH_INDEX = 0;

    public string $definitionPath {
        get => $this->getData(self::DEFINITION_PATH_INDEX);
        set {
            $this->setData(self::DEFINITION_PATH_INDEX, $value);
        }
    }

    // hashFileName
    public const string HASH_FILE_NAME_PROP = 'hashFileName';
    private const int HASH_FILE_NAME_INDEX = 1;

    public protected(set) string $hashFileName {
        get => $this->getData(self::HASH_FILE_NAME_INDEX);
        set {
            $this->setData(self::HASH_FILE_NAME_INDEX, $value);
        }
    }

    // isCacheEnabled
    public const string IS_CACHE_ENABLED_PROP = 'isCacheEnabled';
    private const int IS_CACHE_ENABLED_INDEX = 2;

    public protected(set) bool $isCacheEnabled {
        get => $this->getData(self::IS_CACHE_ENABLED_INDEX);
        set {
            $this->setData(self::IS_CACHE_ENABLED_INDEX, $value);
        }
    }

    // relativeDefinitionPath
    public const string RELATIVE_DEFINITION_PATH_PROP = 'relativeDefinitionPath';
    private const int RELATIVE_DEFINITION_PATH_INDEX = 3;

    public string $relativeDefinitionPath {
        get => $this->getData(self::RELATIVE_DEFINITION_PATH_INDEX);
        set {
            $this->setData(self::RELATIVE_DEFINITION_PATH_INDEX, $value);
        }
    }

    // transferNamespace
    public const string TRANSFER_NAMESPACE_PROP = 'transferNamespace';
    private const int TRANSFER_NAMESPACE_INDEX = 4;

    public string $transferNamespace {
        get => $this->getData(self::TRANSFER_NAMESPACE_INDEX);
        set {
            $this->setData(self::TRANSFER_NAMESPACE_INDEX, $value);
        }
    }

    // transferPath
    public const string TRANSFER_PATH_PROP = 'transferPath';
    private const int TRANSFER_PATH_INDEX = 5;

    public string $transferPath {
        get => $this->getData(self::TRANSFER_PATH_INDEX);
        set {
            $this->setData(self::TRANSFER_PATH_INDEX, $value);
        }
    }

    // uuid
    public const string UUID_PROP = 'uuid';
    private const int UUID_INDEX = 6;

    public protected(set) string $uuid {
        get => $this->getData(self::UUID_INDEX);
        set {
            $this->setData(self::UUID_INDEX, $value);
        }
    }
}
