<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Filesystem;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Exception\FileLocalException;
use Picamator\TransferObject\Shared\Exception\FileReaderException;
use Picamator\TransferObject\Shared\Filesystem\FileReader;

class FileReaderTest extends TestCase
{
    private const string FILE_NAME = 'test.yml';

    private FileReader&MockObject $fileReaderMock;

    /**
     * @var false|resource|null
     */
    private $file;

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

    protected function tearDown(): void
    {
        if (!isset($this->file) || $this->file === false) {
            return;
        }

        fclose($this->file);
        unset($this->file);
    }

    public function testFileIsNotLocalShouldRiseException(): void
    {
        // Arrange
        $filename = 'https://some-domain.io/' . self::FILE_NAME;

        // Expect
        $this->expectException(FileLocalException::class);

        // Act
        $this->fileReaderMock->readFile($filename)->current();
    }

    public function testFailToOpenFileShouldRiseException(): void
    {
        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->willReturn(false);

        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderMock->readFile(self::FILE_NAME)->current();
    }

    public function testFailToReadWholeFileShouldRiseException(): void
    {
        // Arrange
        $file = $this->getFile();

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->willReturn($file);

        $this->fileReaderMock->expects($this->once())
            ->method('fgets')
            ->willReturn(false);

        $this->fileReaderMock->expects($this->once())
            ->method('feof')
            ->willReturn(false);

        $this->fileReaderMock->expects($this->once())
            ->method('fclose')
            ->willReturn(true);

        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderMock->readFile(self::FILE_NAME)->current();
    }

    public function testFailToCloseFileShouldRiseException(): void
    {
        // Arrange
        $file = $this->getFile();

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->willReturn($file);

        $this->fileReaderMock->expects($this->once())
            ->method('fgets')
            ->willReturn(false);

        $this->fileReaderMock->expects($this->once())
            ->method('feof')
            ->willReturn(true);

        $this->fileReaderMock->expects($this->once())
            ->method('fclose')
            ->willReturn(false);

        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderMock->readFile(self::FILE_NAME)->current();
    }

    public function testReadFileShouldSkipEmptyLines(): void
    {
        // Arrange
        $file = $this->getFile();
        $expected = ['some.config.yml'];

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('fopen')
            ->willReturn($file);

        $this->fileReaderMock->expects($this->exactly(3))
            ->method('fgets')
            ->willReturnOnConsecutiveCalls('', $expected[0], false);

        $this->fileReaderMock->expects($this->once())
            ->method('feof')
            ->willReturn(true);

        $this->fileReaderMock->expects($this->once())
            ->method('fclose')
            ->willReturn(true);

        // Act
        $actual = $this->fileReaderMock->readFile(self::FILE_NAME);

        // Assert
        $this->assertSame($expected, iterator_to_array($actual));
    }

    /**
     * @return false|resource
     */
    private function getFile()
    {
        return $this->file ??= fopen('php://temp', 'r');
    }
}
