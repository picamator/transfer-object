<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Environment;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Environment\EnvironmentReader;
use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;

#[Group('shared')]
class EnvironmentReaderTest extends TestCase
{
    private EnvironmentReaderInterface&MockObject $readerMock;

    protected function setUp(): void
    {
        $this->readerMock = $this->getMockBuilder(EnvironmentReader::class)
            ->onlyMethods([
                'getenv',
                'getcwd',
            ])
            ->getMock();
    }

    #[TestDox('Environment variable project root "$projectRoot" is set with "$expected"')]
    #[TestWith(['/home/my-user', '/home/my-user'])]
    #[TestWith([' /home/my-user/ ', '/home/my-user'])]
    public function testProjectRootVariableIsSet(string $projectRoot, string $expected): void
    {
        // Expect
        $this->readerMock->expects($this->once())
            ->method('getenv')
            ->willReturn($projectRoot);

        $this->readerMock->expects($this->never())
            ->method('getcwd')
            ->seal();

        // Act
        $actual = $this->readerMock->getProjectRoot();

        // Assert
        $this->assertSame($expected, $actual);
    }

    #[TestDox('Environment variable project root is not set should fallback to current working directory')]
    public function testProjectRootVariableIsNotSetShouldFallbackToCurrentWorkingDirectory(): void
    {
        // Arrange
        $projectRoot = false;
        $workingDirectory = '/home/work-dir/my-user';

        // Expect
        $this->readerMock->expects($this->once())
            ->method('getenv')
            ->willReturn($projectRoot);

        $this->readerMock->expects($this->once())
            ->method('getcwd')
            ->willReturn($workingDirectory)
            ->seal();

        // Act
        $actual = $this->readerMock->getProjectRoot();

        // Assert
        $this->assertSame($workingDirectory, $actual);
    }

    #[TestDox('Environment variable project root is not set and current working directory is failed')]
    public function testProjectRootVariableIsNotSetAndWorkingDirectoryIsFailed(): void
    {
        // Arrange
        $projectRoot = false;
        $workingDirectory = false;

        $expected = '';

        // Expect
        $this->readerMock->expects($this->once())
            ->method('getenv')
            ->willReturn($projectRoot);

        $this->readerMock->expects($this->once())
            ->method('getcwd')
            ->willReturn($workingDirectory)
            ->seal();

        // Act
        $actual = $this->readerMock->getProjectRoot();

        // Assert
        $this->assertSame($expected, $actual);
    }
}
