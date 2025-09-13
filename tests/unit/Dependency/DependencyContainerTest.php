<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Dependency;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;

#[Group('dependency')]
class DependencyContainerTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = new DependencyContainer();
    }

    public function testGettingUnknownServiceShouldThrowException(): void
    {
        // Arrange
        $id = 'TEST_SERVICE';

        // Expect
        $this->expectException(ServiceNotFoundException::class);

        // Act
        $this->container->get($id);
    }
}
