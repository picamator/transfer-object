<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Filesystem;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Unit\TransferObject\Helper\FileStreamHelperTrait;
use Picamator\TransferObject\Shared\Exception\FileAppenderException;
use Picamator\TransferObject\Shared\Filesystem\FileAppender;

#[Group('shared')]
class FileAppenderTest extends TestCase
{
    use FileStreamHelperTrait;

    private const string FILE_NAME = 'test.yml';
    private const string FILE_CONTENT = 'test content';

    private FileAppender&MockObject $fileAppenderMock;

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
        $this->closeTempFileStream();
    }

    #[TestDox('Failed open file should throw exception')]
    public function testFailedOpenFileShouldThrowException(): void
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

    #[TestDox('Failed write file should throw exception')]
    public function testFailedWriteFileShouldThrowException(): void
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

    #[TestDox('Successful write file')]
    public function testSuccessfulWriteFile(): void
    {
        // Arrange
        $file = $this->getTempFileStream();

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

    #[TestDox('Close file')]
    public function testCloseFile(): void
    {
        // Arrange
        $file = $this->getTempFileStream();

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

    #[TestDox('File is not exist in the cache should skip closing file')]
    public function testFileIsNotExistInTheCacheShouldSkipCloseFile(): void
    {
        // Arrange
        $fileName = 'some-name.txt';

        // Expect
        $this->fileAppenderMock->expects($this->never())
            ->method('fclose');

        // Act
        $this->fileAppenderMock->closeFile($fileName);
    }

    #[TestDox('Failed to close the file')]
    public function testFailedCloseFile(): void
    {
        // Arrange
        $file = $this->getTempFileStream();

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
}
