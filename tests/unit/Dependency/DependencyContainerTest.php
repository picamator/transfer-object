<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Dependency;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\DependencyContainer;
use Picamator\TransferObject\Dependency\Exception\NotFoundContainerException;
use Psr\Container\ContainerInterface;

#[Group('dependency')]
class DependencyContainerTest extends TestCase
{
    private ContainerInterface $container;

    protected function setUp(): void
    {
        $this->container = new DependencyContainer();
    }

    #[TestDox('Getting unknown service should throw exception')]
    public function testGettingUnknownServiceShouldThrowException(): void
    {
        // Arrange
        $id = 'TEST_SERVICE';

        // Expect
        $this->expectException(NotFoundContainerException::class);

        // Act
        $this->container->get($id);
    }
}
