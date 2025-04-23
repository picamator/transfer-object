<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Filesystem;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Exception\FileAppenderException;
use Picamator\TransferObject\Shared\Filesystem\FileAppender;

class FileAppenderTest extends TestCase
{
    private FileAppender&MockObject $fileAppenderMock;

    private const string FILE_NAME = 'test.yml';
    private const string FILE_CONTENT = 'test content';

    protected function setUp(): void
    {
        $this->fileAppenderMock = $this->getMockBuilder(FileAppender::class)
            ->onlyMethods([
                'fwrite',
                'fopen',
                'fclose',
            ])->getMock();
    }

    public function testFailedOpenFileShouldRiseException(): void
    {
        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn(false);

        $this->expectException(FileAppenderException::class);

        // Act
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
    }

    public function testFailedWriteFileShouldRiseException(): void
    {
        // Arrange
        $file = fopen('php://temp', 'r');

        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileAppenderMock->expects($this->once())
            ->method('fwrite')
            ->willReturn(false);

        $this->expectException(FileAppenderException::class);

        // Act
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
    }

    public function testSuccessfulWriteFile(): void
    {
        // Arrange
        $file = fopen('php://temp', 'r');

        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileAppenderMock->expects($this->exactly(2))
            ->method('fwrite')
            ->willReturn(1);

        // Act
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
    }

    public function testCloseFile(): void
    {
        // Arrange
        $file = fopen('php://temp', 'r');

        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileAppenderMock->expects($this->once())
            ->method('fwrite')
            ->willReturn(1);

        $this->fileAppenderMock->expects($this->once())
            ->method('fclose');

        // Act
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
        $this->fileAppenderMock->__destruct();
    }

    public function testSkipCloseFile(): void
    {
        // Expect
        $this->fileAppenderMock->expects($this->never())
            ->method('fclose');

        // Act
        $this->fileAppenderMock->__destruct();
    }
}
