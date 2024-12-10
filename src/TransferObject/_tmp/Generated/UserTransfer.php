<?php declare(strict_types = 1);

namespace Picamator\TransferObject\_tmp\Generated;

use Picamator\TransferObject\Transfer\AbstractTransfer;

final class UserTransfer extends AbstractTransfer
{
    protected const int META_DATA_SIZE = 3;

    protected const array META_DATA = [
        self::FIRST_NAME => self::FIRST_NAME_DATA_NAME,
        self::LAST_NAME => self::LAST_NAME_DATA_NAME,
        self::ROLES => self::ROLES_DATA_NAME,
    ];

    public const string FIRST_NAME = 'firstName';
    protected const string FIRST_NAME_DATA_NAME = 'FIRST_NAME';
    protected const int FIRST_NAME_DATA_INDEX = 0;

    public const string LAST_NAME = 'lastName';
    protected const string LAST_NAME_DATA_NAME = 'LAST_NAME';
    protected const int LAST_NAME_DATA_INDEX = 1;

    public const string ROLES = 'roles';
    protected const string ROLES_DATA_NAME = 'ROLES';
    protected const int ROLES_DATA_INDEX = 2;

    public ?string $firstName {
        get => $this->data[self::FIRST_NAME_DATA_INDEX];
        set => $this->data[self::FIRST_NAME_DATA_INDEX] = $value;
    }

    public ?string $lastName {
        get => $this->data[self::LAST_NAME_DATA_INDEX];
        set => $this->data[self::LAST_NAME_DATA_INDEX] = $value;
    }

    public ?string $roles {
        get => $this->data[self::ROLES_DATA_INDEX];
        set => $this->data[self::ROLES_DATA_INDEX] = $value;
    }
}
