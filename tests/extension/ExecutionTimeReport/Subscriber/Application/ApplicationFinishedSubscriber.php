<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\Application;

use LimitIterator;
use PHPUnit\Event\Application\Finished;
use PHPUnit\Event\Application\FinishedSubscriber;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReport;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReportItem;

readonly class ApplicationFinishedSubscriber implements FinishedSubscriber
{
    private const string TIME_REPORT_TEMPLATE = "📌 \e[33m[%s]\e[0m %s \033[1m%s ms\033[0m\n";

    public function __construct(private TimeReport $timeReport)
    {
    }

    public function notify(Finished $event): void
    {
        if ($event->shellExitCode() !== 0 || $this->timeReport->count() === 0) {
            return;
        }

        echo PHP_EOL;

        foreach ($this->getTimeReportIterator() as $timeReportItem) {
            echo $this->renderTemplate($timeReportItem);
        }

        echo PHP_EOL;
    }

    private function renderTemplate(TimeReportItem $timeReportItem): string
    {
        $testSuite = $this->getTestSuite($timeReportItem);
        $duration = $this->getDuration($timeReportItem);

        return sprintf(
            self::TIME_REPORT_TEMPLATE,
            $timeReportItem->group,
            $testSuite,
            $duration,
        );
    }

    private function getDuration(TimeReportItem $timeReportItem): string
    {
        $duration = $timeReportItem->duration?->nanoseconds() ?? 0;
        $duration = $duration / 1_000_000;

        return number_format($duration, 3);
    }

    private function getTestSuite(TimeReportItem $timeReportItem): string
    {
        $testSuite = strrchr($timeReportItem->testSuite, '\\') ?: $timeReportItem->testSuite;

        return ltrim($testSuite, '\\');
    }

    /**
     * @return LimitIterator<string, TimeReportItem, \ArrayIterator<string, TimeReportItem>>
     */
    private function getTimeReportIterator(): LimitIterator
    {
        $this->timeReport->data->uasort($this->sortTimeReportItem(...));

        return new LimitIterator(
            iterator: $this->timeReport->data->getIterator(),
            limit: $this->timeReport->parameter->limit
        );
    }

    private function sortTimeReportItem(TimeReportItem $itemA, TimeReportItem $itemB): int
    {
        return $itemB->duration?->nanoseconds() <=> $itemA->duration?->nanoseconds();
    }
}
