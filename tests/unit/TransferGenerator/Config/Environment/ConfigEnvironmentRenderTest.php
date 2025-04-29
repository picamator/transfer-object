<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Config\Environment;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\TransferGenerator\Config\Environment\ConfigEnvironmentRender;

class ConfigEnvironmentRenderTest extends TestCase
{
    private ConfigEnvironmentRender&MockObject $renderMock;

    protected function setUp(): void
    {
        $this->renderMock = $this->getMockBuilder(ConfigEnvironmentRender::class)
            ->onlyMethods(['getWorkingDir', 'getEnvironment'])
            ->getMock();
    }

    public function testEnvironmentVariableIsSet(): void
    {
        // Arrange
        $configPath = '${PROJECT_ROOT}/some-config-path.yml';
        $envProjectRoot = '/home/my-user';
        $expected = '/home/my-user/some-config-path.yml';

        // Expect
        $this->renderMock->expects($this->once())
            ->method('getEnvironment')
            ->willReturn($envProjectRoot);

        $this->renderMock->expects($this->never())
            ->method('getWorkingDir');

        // Act
        $this->renderMock->renderProjectRoot($configPath);
        $actual = $this->renderMock->renderProjectRoot($configPath); // duplicate run to test internal cache

        // Assert
        $this->assertSame($expected, $actual);
    }

    public function testEnvironmentVariableIsNotSetShouldRollbackToWorkingDirectory(): void
    {
        // Arrange
        $configPath = '${PROJECT_ROOT}/some-config-path.yml';
        $workingDirectory = '/home/my-user';
        $expected = '/home/my-user/some-config-path.yml';

        // Expect
        $this->renderMock->expects($this->once())
            ->method('getEnvironment')
            ->willReturn('');

        $this->renderMock->expects($this->once())
            ->method('getWorkingDir')
            ->willReturn($workingDirectory);

        // Act
        $actual = $this->renderMock->renderProjectRoot($configPath);

        // Assert
        $this->assertSame($expected, $actual);
    }
}
