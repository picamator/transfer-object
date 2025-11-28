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
        self::CATEGORY_PROP => self::CATEGORY_INDEX,
        self::LANGUAGE_PROP => self::LANGUAGE_INDEX,
        self::PAGELENGTH_PROP => self::PAGELENGTH_INDEX,
        self::PASSWORD_PROP => self::PASSWORD_INDEX,
        self::TERM_PROP => self::TERM_INDEX,
        self::USERNAME_PROP => self::USERNAME_INDEX,
    ];

    // category
    public const string CATEGORY_PROP = 'category';
    private const int CATEGORY_INDEX = 0;

    public ?string $category {
        get => $this->getData(self::CATEGORY_INDEX);
        set => $this->setData(self::CATEGORY_INDEX, $value);
    }

    // language
    public const string LANGUAGE_PROP = 'language';
    private const int LANGUAGE_INDEX = 1;

    public ?string $language {
        get => $this->getData(self::LANGUAGE_INDEX);
        set => $this->setData(self::LANGUAGE_INDEX, $value);
    }

    // pagelength
    public const string PAGELENGTH_PROP = 'pagelength';
    private const int PAGELENGTH_INDEX = 2;

    public ?string $pagelength {
        get => $this->getData(self::PAGELENGTH_INDEX);
        set => $this->setData(self::PAGELENGTH_INDEX, $value);
    }

    // password
    public const string PASSWORD_PROP = 'password';
    private const int PASSWORD_INDEX = 3;

    public ?string $password {
        get => $this->getData(self::PASSWORD_INDEX);
        set => $this->setData(self::PASSWORD_INDEX, $value);
    }

    // term
    public const string TERM_PROP = 'term';
    private const int TERM_INDEX = 4;

    public ?string $term {
        get => $this->getData(self::TERM_INDEX);
        set => $this->setData(self::TERM_INDEX, $value);
    }

    // username
    public const string USERNAME_PROP = 'username';
    private const int USERNAME_INDEX = 5;

    public ?string $username {
        get => $this->getData(self::USERNAME_INDEX);
        set => $this->setData(self::USERNAME_INDEX, $value);
    }
}
