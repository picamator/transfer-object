<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Filesystem;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Unit\TransferObject\Helper\FileTrait;
use Picamator\TransferObject\Shared\Exception\FileReaderException;
use Picamator\TransferObject\Shared\Filesystem\FileReader;

#[Group('shared')]
class FileReaderTest extends TestCase
{
    use FileTrait;

    private const string FILE_NAME = 'test.yml';

    private FileReader&MockObject $fileReaderMock;

    protected function setUp(): void
    {
        $this->fileReaderMock = $this->getMockBuilder(FileReader::class)
            ->onlyMethods([
                'fopen',
                'fgets',
                'feof',
                'fclose',
            ])->getMock();
    }

    public static function tearDownAfterClass(): void
    {
        self::closeFile();
    }

    #[TestDox('Failed open file should throw exception')]
    public function testFailOpenFileShouldThrowException(): void
    {
        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn(false);

        $this->fileReaderMock->expects($this->never())
            ->method('fgets');

        $this->fileReaderMock->expects($this->never())
            ->method('feof');

        $this->fileReaderMock->expects($this->never())
            ->method('fclose');

        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderMock->readFile(self::FILE_NAME)->current();
    }

    #[TestDox('Failed read file should throw exception')]
    public function testFailedReadFileShouldThrowException(): void
    {
        // Arrange
        $file = self::openFile();

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileReaderMock->expects($this->once())
            ->method('fgets')
            ->with($this->isResource())
            ->willReturn(false);

        $this->fileReaderMock->expects($this->once())
            ->method('feof')
            ->with($this->isResource())
            ->willReturn(false);

        $this->fileReaderMock->expects($this->once())
            ->method('fclose')
            ->with($this->isResource())
            ->willReturn(true);

        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderMock->readFile(self::FILE_NAME)->current();
    }

    #[TestDox('Failed close file should throw exception')]
    public function testFailedCloseFileShouldThrowException(): void
    {
        // Arrange
        $file = self::openFile();

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileReaderMock->expects($this->once())
            ->method('fgets')
            ->with($this->isResource())
            ->willReturn(false);

        $this->fileReaderMock->expects($this->once())
            ->method('feof')
            ->with($this->isResource())
            ->willReturn(true);

        $this->fileReaderMock->expects($this->once())
            ->method('fclose')
            ->with($this->isResource())
            ->willReturn(false);

        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderMock->readFile(self::FILE_NAME)->current();
    }

    #[TestDox('Read file should skip empty lines')]
    public function testReadFileShouldSkipEmptyLines(): void
    {
        // Arrange
        $file = self::openFile();
        $expected = ['some.config.yml'];

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->with(self::FILE_NAME)
            ->willReturn($file);

        $this->fileReaderMock->expects($this->exactly(3))
            ->method('fgets')
            ->with($this->isResource())
            ->willReturn('', $expected[0], false);

        $this->fileReaderMock->expects($this->once())
            ->method('feof')
            ->with($this->isResource())
            ->willReturn(true);

        $this->fileReaderMock->expects($this->once())
            ->method('fclose')
            ->with($this->isResource())
            ->willReturn(true);

        // Act
        $actual = $this->fileReaderMock->readFile(self::FILE_NAME);

        // Assert
        $this->assertArraysAreIdentical($expected, iterator_to_array($actual));
    }
}
