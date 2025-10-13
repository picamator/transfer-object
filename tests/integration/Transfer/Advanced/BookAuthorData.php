<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Advanced;

use Picamator\TransferObject\Transfer\Adapter\TransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

class BookAuthorData implements TransferInterface
{
    use TransferAdapterTrait;

    public string $firstName;

    public string $lastName;
}
