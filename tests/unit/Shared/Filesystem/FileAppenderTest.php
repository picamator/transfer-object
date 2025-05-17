<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Filesystem;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Exception\FileAppenderException;
use Picamator\TransferObject\Shared\Filesystem\FileAppender;

class FileAppenderTest extends TestCase
{
    private const string FILE_NAME = 'test.yml';
    private const string FILE_CONTENT = 'test content';

    private FileAppender&MockObject $fileAppenderMock;

    /**
     * @var false|resource|null
     */
    private $file;

    protected function setUp(): void
    {
        $this->fileAppenderMock = $this->getMockBuilder(FileAppender::class)
            ->onlyMethods([
                'fwrite',
                'fopen',
                'fclose',
            ])->getMock();
    }

    protected function tearDown(): void
    {
        if (!isset($this->file) || $this->file === false) {
            return;
        }

        fclose($this->file);
        unset($this->file);
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
        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($this->file);

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
        $file = $this->getFile();

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
        $file = $this->getFile();

        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileAppenderMock->expects($this->once())
            ->method('fwrite')
            ->willReturn(1);

        $this->fileAppenderMock->expects($this->once())
            ->method('fclose')
            ->willReturn(true);

        // Act
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
        $this->fileAppenderMock->closeFile(self::FILE_NAME);
    }

    public function testFailedCloseFile(): void
    {
        // Arrange
        $file = $this->getFile();

        // Expect
        $this->fileAppenderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileAppenderMock->expects($this->once())
            ->method('fwrite')
            ->willReturn(1);

        $this->fileAppenderMock->expects($this->once())
            ->method('fclose')
            ->willReturn(false);

        $this->expectException(FileAppenderException::class);

        // Act
        $this->fileAppenderMock->appendToFile(self::FILE_NAME, self::FILE_CONTENT);
        $this->fileAppenderMock->closeFile(self::FILE_NAME);
    }

    /**
     * @return false|resource
     */
    private function getFile()
    {
        return $this->file ??= fopen('php://temp', 'r');
    }
}
