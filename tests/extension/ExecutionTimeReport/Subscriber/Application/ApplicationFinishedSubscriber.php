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

    /**
     * phpcs:disable SlevomatCodingStandard.Functions.UnusedParameter
     */
    public function notify(Finished $event): void
    {
        echo PHP_EOL;

        foreach ($this->getTimeReportIterator() as $timeReportItem) {
            echo $this->renderTemplate($timeReportItem);
        }

        echo PHP_EOL;
    }

    private function renderTemplate(TimeReportItem $timeReportItem): string
    {
        $testSuite = strrchr($timeReportItem->testSuite, '\\') ?: $timeReportItem->testSuite;
        $testSuite = ltrim($testSuite, '\\');

        $duration = $timeReportItem->duration?->nanoseconds() ?? 0;
        $duration = $duration / 10 ** 6;
        $duration = number_format($duration, 3);

        return sprintf(
            self::TIME_REPORT_TEMPLATE,
            $timeReportItem->group,
            $testSuite,
            $duration,
        );
    }

    /**
     * @return LimitIterator<string, TimeReportItem, \ArrayIterator<string, TimeReportItem>>
     */
    private function getTimeReportIterator(): LimitIterator
    {
        $this->timeReport->data->uasort($this->sortTimeReport(...));

        return new LimitIterator($this->timeReport->data->getIterator(), 0, $this->timeReport->parameter->limit);
    }

    /**
     * @return int
     */
    private function sortTimeReport(TimeReportItem $itemA, TimeReportItem $itemB): int
    {
        return $itemB->duration?->nanoseconds() <=> $itemA->duration?->nanoseconds();
    }
}
