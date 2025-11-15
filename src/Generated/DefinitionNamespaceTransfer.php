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
final class DefinitionNamespaceTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::ALIAS => self::ALIAS_INDEX,
        self::BASE_NAME => self::BASE_NAME_INDEX,
        self::FULL_NAME => self::FULL_NAME_INDEX,
        self::WITHOUT_ALIAS => self::WITHOUT_ALIAS_INDEX,
    ];

    // alias
    public const string ALIAS = 'alias';
    private const int ALIAS_INDEX = 0;

    public ?string $alias {
        get => $this->getData(self::ALIAS_INDEX);
        set => $this->setData(self::ALIAS_INDEX, $value);
    }

    // baseName
    public const string BASE_NAME = 'baseName';
    private const int BASE_NAME_INDEX = 1;

    public string $baseName {
        get => $this->getData(self::BASE_NAME_INDEX);
        set => $this->setData(self::BASE_NAME_INDEX, $value);
    }

    // fullName
    public const string FULL_NAME = 'fullName';
    private const int FULL_NAME_INDEX = 2;

    public string $fullName {
        get => $this->getData(self::FULL_NAME_INDEX);
        set => $this->setData(self::FULL_NAME_INDEX, $value);
    }

    // withoutAlias
    public const string WITHOUT_ALIAS = 'withoutAlias';
    private const int WITHOUT_ALIAS_INDEX = 3;

    public string $withoutAlias {
        get => $this->getData(self::WITHOUT_ALIAS_INDEX);
        set => $this->setData(self::WITHOUT_ALIAS_INDEX, $value);
    }
}
