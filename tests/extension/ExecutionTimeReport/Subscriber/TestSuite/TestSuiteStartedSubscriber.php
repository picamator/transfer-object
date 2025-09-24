<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\TestSuite;

use PHPUnit\Event\TestSuite\Started;
use PHPUnit\Event\TestSuite\StartedSubscriber;
use PHPUnit\Framework\Attributes\Group;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReport;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReportItem;
use ReflectionClass;

readonly class TestSuiteStartedSubscriber implements StartedSubscriber
{
    use TestSubscriberTrait;

    public function __construct(private TimeReport $timeReport)
    {
    }

    public function notify(Started $event): void
    {
        $testSuiteName = $this->getTestSuiteName($event);
        if (!class_exists($testSuiteName)) {
            return;
        }

        $this->timeReport->data[$testSuiteName] ??= new TimeReportItem(
            group: $this->getGroupName($testSuiteName),
            testSuite: $testSuiteName,
            startTime: $event->telemetryInfo()->time(),
        );
    }

    private function getGroupName(string $testSuiteName): string
    {
        /** @var class-string<\PHPUnit\Framework\TestCase> $testSuiteName */
        $reflection = new ReflectionClass($testSuiteName);
        $reflectionAttribute = $reflection->getAttributes(Group::class)[0] ?? null;

        if ($reflectionAttribute === null) {
            return '';
        }

        /** @var Group $groupAttribute */
        $groupAttribute = $reflectionAttribute->newInstance();

        return $groupAttribute->name();
    }
}
