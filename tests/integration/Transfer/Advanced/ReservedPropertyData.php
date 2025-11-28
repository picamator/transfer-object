<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Transfer\Advanced;

use Picamator\TransferObject\Transfer\Adapter\TransferAdapterTrait;
use Picamator\TransferObject\Transfer\TransferInterface;

/**
 * @uses \Picamator\TransferObject\TransferGenerator\Definition\Enum\ReservedPropertyEnum
 */
class ReservedPropertyData implements TransferInterface
{
    use TransferAdapterTrait;

    public function __construct(
        public ?string $_data = null,
    ) {
    }
}
