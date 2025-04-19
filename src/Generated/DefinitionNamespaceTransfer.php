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
 */
final class DefinitionNamespaceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::ALIAS => self::ALIAS_DATA_NAME,
        self::BASE_NAME => self::BASE_NAME_DATA_NAME,
        self::FULL_NAME => self::FULL_NAME_DATA_NAME,
        self::WITHOUT_ALIAS => self::WITHOUT_ALIAS_DATA_NAME,
    ];

    // alias
    public const string ALIAS = 'alias';
    protected const string ALIAS_DATA_NAME = 'ALIAS';
    protected const int ALIAS_DATA_INDEX = 0;

    public ?string $alias {
        get => $this->_data[self::ALIAS_DATA_INDEX];
        set => $this->_data[self::ALIAS_DATA_INDEX] = $value;
    }

    // baseName
    public const string BASE_NAME = 'baseName';
    protected const string BASE_NAME_DATA_NAME = 'BASE_NAME';
    protected const int BASE_NAME_DATA_INDEX = 1;

    public string $baseName {
        get => $this->_data[self::BASE_NAME_DATA_INDEX];
        set => $this->_data[self::BASE_NAME_DATA_INDEX] = $value;
    }

    // fullName
    public const string FULL_NAME = 'fullName';
    protected const string FULL_NAME_DATA_NAME = 'FULL_NAME';
    protected const int FULL_NAME_DATA_INDEX = 2;

    public string $fullName {
        get => $this->_data[self::FULL_NAME_DATA_INDEX];
        set => $this->_data[self::FULL_NAME_DATA_INDEX] = $value;
    }

    // withoutAlias
    public const string WITHOUT_ALIAS = 'withoutAlias';
    protected const string WITHOUT_ALIAS_DATA_NAME = 'WITHOUT_ALIAS';
    protected const int WITHOUT_ALIAS_DATA_INDEX = 3;

    public string $withoutAlias {
        get => $this->_data[self::WITHOUT_ALIAS_DATA_INDEX];
        set => $this->_data[self::WITHOUT_ALIAS_DATA_INDEX] = $value;
    }
}
