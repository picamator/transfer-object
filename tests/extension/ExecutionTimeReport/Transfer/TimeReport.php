<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer;

use ArrayObject;

final class TimeReport
{
    /**
     * @param \ArrayObject<string, TimeReportItem> $data
     */
    public function __construct(
        public readonly TimeReportParameter $parameter,
        public ArrayObject $data = new ArrayObject(),
    ) {
    }
}
