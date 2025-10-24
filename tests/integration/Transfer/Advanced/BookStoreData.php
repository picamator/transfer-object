<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Advanced;

use Picamator\TransferObject\Transfer\Adapter\TransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

class BookStoreData implements TransferInterface
{
    use TransferAdapterTrait;

    public function __construct(
        public ?string $uuid = null,
    ) {
    }
}
