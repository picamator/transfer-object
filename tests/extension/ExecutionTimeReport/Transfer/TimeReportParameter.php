<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer;

readonly final class TimeReportParameter
{
    public function __construct(public int $limit)
    {
    }
}
