<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator;

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
 * @see /doc/samples/config/transfer-generator/definition/credentials.transfer.yml Definition file path.
 */
final class CredentialsTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 4;

    protected const array META_DATA = [
        self::CREATED_AT => self::CREATED_AT_DATA_NAME,
        self::LOGIN => self::LOGIN_DATA_NAME,
        self::TOKEN => self::TOKEN_DATA_NAME,
        self::UPDATED_AT => self::UPDATED_AT_DATA_NAME,
    ];

    // createdAt
    #[DateTimePropertyTypeAttribute(DateTimeImmutable::class)]
    public const string CREATED_AT = 'createdAt';
    protected const string CREATED_AT_DATA_NAME = 'CREATED_AT';
    protected const int CREATED_AT_DATA_INDEX = 0;

    public protected(set) DateTimeImmutable $createdAt {
        get => $this->getData(self::CREATED_AT_DATA_INDEX);
        set => $this->setData(self::CREATED_AT_DATA_INDEX, $value);
    }

    // login
    public const string LOGIN = 'login';
    protected const string LOGIN_DATA_NAME = 'LOGIN';
    protected const int LOGIN_DATA_INDEX = 1;

    public protected(set) string $login {
        get => $this->getData(self::LOGIN_DATA_INDEX);
        set => $this->setData(self::LOGIN_DATA_INDEX, $value);
    }

    // token
    public const string TOKEN = 'token';
    protected const string TOKEN_DATA_NAME = 'TOKEN';
    protected const int TOKEN_DATA_INDEX = 2;

    public protected(set) string $token {
        get => $this->getData(self::TOKEN_DATA_INDEX);
        set => $this->setData(self::TOKEN_DATA_INDEX, $value);
    }

    // updatedAt
    #[DateTimePropertyTypeAttribute(DateTime::class)]
    public const string UPDATED_AT = 'updatedAt';
    protected const string UPDATED_AT_DATA_NAME = 'UPDATED_AT';
    protected const int UPDATED_AT_DATA_INDEX = 3;

    public DateTime $updatedAt {
        get => $this->getData(self::UPDATED_AT_DATA_INDEX);
        set => $this->setData(self::UPDATED_AT_DATA_INDEX, $value);
    }
}
