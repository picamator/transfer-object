<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport;

use PHPUnit\Runner\Extension\Extension;
use PHPUnit\Runner\Extension\Facade;
use PHPUnit\Runner\Extension\ParameterCollection;
use PHPUnit\TextUI\Configuration\Configuration;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\Application\ApplicationFinishedSubscriber;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\TestSuite\TestSuiteFinishedSubscriber;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\TestSuite\TestSuiteStartedSubscriber;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReport;
use Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Transfer\TimeReportParameter;

/**
 * Specification:
 * - Collects TestSuit's execution time.
 * - Shows TestSuits list with execution time.
 * - Limits TestSuit list by configurable parameter `total` with default value 10.
 *
 * @see https://docs.phpunit.de
 */
class ExecutionTimeReportExtension implements Extension
{
    private const string PARAMETER_NAME_TOTAL = 'total';
    private const int PARAMETER_DEFAULT_TOTAL = 10;

    public function bootstrap(Configuration $configuration, Facade $facade, ParameterCollection $parameters): void
    {
        if ($configuration->noExtensions() || $configuration->noOutput()) {
            return;
        }

        $timeReport = $this->createTimeReport($parameters);

        $facade->registerSubscriber(new TestSuiteStartedSubscriber($timeReport));
        $facade->registerSubscriber(new TestSuiteFinishedSubscriber($timeReport));
        $facade->registerSubscriber(new ApplicationFinishedSubscriber($timeReport));
    }

    private function createTimeReport(ParameterCollection $parameters): TimeReport
    {
        $limit = $parameters->has(self::PARAMETER_NAME_TOTAL)
            ? (int)$parameters->get(self::PARAMETER_NAME_TOTAL)
            : self::PARAMETER_DEFAULT_TOTAL;

        $timeReportParameter = new TimeReportParameter($limit);

        return new TimeReport($timeReportParameter);
    }
}
