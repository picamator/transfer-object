<?php

declare(strict_types=1);

namespace Picamator\Doc\Samples\TransferObject\Generated\TransferGenerator;

use Picamator\TransferObject\Transfer\AbstractTransfer;

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
    protected const int META_DATA_SIZE = 2;

    protected const array META_DATA = [
        self::LOGIN => self::LOGIN_DATA_NAME,
        self::TOKEN => self::TOKEN_DATA_NAME,
    ];

    // login
    public const string LOGIN = 'login';
    protected const string LOGIN_DATA_NAME = 'LOGIN';
    protected const int LOGIN_DATA_INDEX = 0;

    public protected(set) string $login {
        get => $this->getData(self::LOGIN_DATA_INDEX);
        set => $this->setData(self::LOGIN_DATA_INDEX, $value);
    }

    // token
    public const string TOKEN = 'token';
    protected const string TOKEN_DATA_NAME = 'TOKEN';
    protected const int TOKEN_DATA_INDEX = 1;

    public protected(set) string $token {
        get => $this->getData(self::TOKEN_DATA_INDEX);
        set => $this->setData(self::TOKEN_DATA_INDEX, $value);
    }
}
