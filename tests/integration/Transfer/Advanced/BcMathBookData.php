<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Advanced;

use BcMath\Number;
use Picamator\TransferObject\Transfer\Adapter\TransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

class BcMathBookData implements TransferInterface
{
    use TransferAdapterTrait;

    public function __construct(
        public ?Number $price = null,
    ) {
    }
}
