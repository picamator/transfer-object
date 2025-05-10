<?php

declare(strict_types=1);

namespace Picamator\Examples\TransferObject\Advanced;

use Picamator\TransferObject\Transfer\DummyTransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

class CredentialsData implements TransferInterface
{
    use DummyTransferAdapterTrait;

    public string $login {
        get => $this->login;
        set => $this->login = $value;
    }

    public string $token {
        get => $this->token;
        set => $this->token = $value;
    }
}
