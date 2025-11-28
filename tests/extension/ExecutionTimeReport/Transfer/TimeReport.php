<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer;

use ArrayObject;
use Countable;

final class TimeReport implements Countable
{
    /**
     * @param \ArrayObject<string, TimeReportItem> $data
     */
    public function __construct(
        public readonly TimeReportParameter $parameter,
        public ArrayObject $data = new ArrayObject(),
    ) {
    }

    public function count(): int
    {
        return $this->data->count();
    }
}
