<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\DefinitionGenerator\Generated\Destatis;

use Picamator\TransferObject\Transfer\AbstractTransfer;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /tests/integration/DefinitionGenerator/data/config/genesis-destatis-find/definition/destatis.transfer.yml Definition file path.
 */
final class ParameterTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 6;

    protected const array META_DATA = [
        self::CATEGORY => self::CATEGORY_DATA_NAME,
        self::LANGUAGE => self::LANGUAGE_DATA_NAME,
        self::PAGELENGTH => self::PAGELENGTH_DATA_NAME,
        self::PASSWORD => self::PASSWORD_DATA_NAME,
        self::TERM => self::TERM_DATA_NAME,
        self::USERNAME => self::USERNAME_DATA_NAME,
    ];

    // category
    public const string CATEGORY = 'category';
    protected const string CATEGORY_DATA_NAME = 'CATEGORY';
    protected const int CATEGORY_DATA_INDEX = 0;

    public ?string $category {
        get => $this->getData(self::CATEGORY_DATA_INDEX);
        set => $this->setData(self::CATEGORY_DATA_INDEX, $value);
    }

    // language
    public const string LANGUAGE = 'language';
    protected const string LANGUAGE_DATA_NAME = 'LANGUAGE';
    protected const int LANGUAGE_DATA_INDEX = 1;

    public ?string $language {
        get => $this->getData(self::LANGUAGE_DATA_INDEX);
        set => $this->setData(self::LANGUAGE_DATA_INDEX, $value);
    }

    // pagelength
    public const string PAGELENGTH = 'pagelength';
    protected const string PAGELENGTH_DATA_NAME = 'PAGELENGTH';
    protected const int PAGELENGTH_DATA_INDEX = 2;

    public ?string $pagelength {
        get => $this->getData(self::PAGELENGTH_DATA_INDEX);
        set => $this->setData(self::PAGELENGTH_DATA_INDEX, $value);
    }

    // password
    public const string PASSWORD = 'password';
    protected const string PASSWORD_DATA_NAME = 'PASSWORD';
    protected const int PASSWORD_DATA_INDEX = 3;

    public ?string $password {
        get => $this->getData(self::PASSWORD_DATA_INDEX);
        set => $this->setData(self::PASSWORD_DATA_INDEX, $value);
    }

    // term
    public const string TERM = 'term';
    protected const string TERM_DATA_NAME = 'TERM';
    protected const int TERM_DATA_INDEX = 4;

    public ?string $term {
        get => $this->getData(self::TERM_DATA_INDEX);
        set => $this->setData(self::TERM_DATA_INDEX, $value);
    }

    // username
    public const string USERNAME = 'username';
    protected const string USERNAME_DATA_NAME = 'USERNAME';
    protected const int USERNAME_DATA_INDEX = 5;

    public ?string $username {
        get => $this->getData(self::USERNAME_DATA_INDEX);
        set => $this->setData(self::USERNAME_DATA_INDEX, $value);
    }
}
