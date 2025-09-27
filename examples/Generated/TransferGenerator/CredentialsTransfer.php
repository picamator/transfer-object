<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Generated\TransferGenerator;

use DateTime;
use DateTimeImmutable;
use Picamator\TransferObject\Transfer\AbstractTransfer;
use Picamator\TransferObject\Transfer\Attribute\DateTimePropertyTypeAttribute;

/**
 * Specification:
 * - Class is automatically generated based on a definition file.
 * - To modify it, please update the corresponding definition file and run the generator again.
 *
 * Note: Do not manually edit this file, as changes will be overwritten.
 *
 * @see /examples/config/transfer-generator/definition/credentials.transfer.yml Definition file path.
 */
final class CredentialsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::CREATED_AT_INDEX => self::CREATED_AT,
        self::LOGIN_INDEX => self::LOGIN,
        self::TOKEN_INDEX => self::TOKEN,
        self::UPDATED_AT_INDEX => self::UPDATED_AT,
    ];

    // createdAt
    #[DateTimePropertyTypeAttribute(DateTimeImmutable::class)]
    public const string CREATED_AT = 'createdAt';
    private const int CREATED_AT_INDEX = 0;

    public protected(set) DateTimeImmutable $createdAt {
        get => $this->getData(self::CREATED_AT_INDEX);
        set => $this->setData(self::CREATED_AT_INDEX, $value);
    }

    // login
    public const string LOGIN = 'login';
    private const int LOGIN_INDEX = 1;

    public protected(set) string $login {
        get => $this->getData(self::LOGIN_INDEX);
        set => $this->setData(self::LOGIN_INDEX, $value);
    }

    // token
    public const string TOKEN = 'token';
    private const int TOKEN_INDEX = 2;

    public protected(set) string $token {
        get => $this->getData(self::TOKEN_INDEX);
        set => $this->setData(self::TOKEN_INDEX, $value);
    }

    // updatedAt
    #[DateTimePropertyTypeAttribute(DateTime::class)]
    public const string UPDATED_AT = 'updatedAt';
    private const int UPDATED_AT_INDEX = 3;

    public DateTime $updatedAt {
        get => $this->getData(self::UPDATED_AT_INDEX);
        set => $this->setData(self::UPDATED_AT_INDEX, $value);
    }
}
