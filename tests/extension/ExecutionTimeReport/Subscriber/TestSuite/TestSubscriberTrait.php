<?php

declare(strict_types=1);

namespace Picamator\Tests\Extension\TransferObject\ExecutionTimeReport\Subscriber\TestSuite;

use PHPUnit\Event\TestSuite\Finished;
use PHPUnit\Event\TestSuite\Started;

trait TestSubscriberTrait
{
    final protected function getTestSuite(Started|Finished $event): string
    {
        return strstr($event->testSuite()->name(), '::', true) ?: '';
    }
}
