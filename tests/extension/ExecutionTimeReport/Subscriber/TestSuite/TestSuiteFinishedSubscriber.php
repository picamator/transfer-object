<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\TestSuite;

use PHPUnit\Event\TestSuite\Finished;
use PHPUnit\Event\TestSuite\FinishedSubscriber;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReport;

readonly class TestSuiteFinishedSubscriber implements FinishedSubscriber
{
    use TestSubscriberTrait;

    public function __construct(private TimeReport $timeReport)
    {
    }

    public function notify(Finished $event): void
    {
        $testSuite = $this->getTestSuite($event);
        $timeReportItem = $this->timeReport->data[$testSuite] ?? null;

        if ($timeReportItem === null) {
            return;
        }

        $endTime = $event->telemetryInfo()->time();

        $timeReportItem->duration = $endTime->duration($timeReportItem->startTime);
    }
}
