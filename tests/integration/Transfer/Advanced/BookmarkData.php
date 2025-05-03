<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Advanced;

use Picamator\TransferObject\Transfer\DummyTransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

class BookmarkData implements TransferInterface
{
    use DummyTransferAdapterTrait;

    public function __construct(
        public ?string $bookmark = null,
    ) {
    }
}
