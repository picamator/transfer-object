<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer;

use PHPUnit\Event\Telemetry\Duration;
use PHPUnit\Event\Telemetry\HRTime;

final class TimeReportItem
{
    public function __construct(
        readonly public string $group,
        readonly public string $testSuite,
        readonly public HRTime $startTime,
        public ?HRTime $endTime = null,
        public ?Duration $duration = null,
    ) {
    }
}
