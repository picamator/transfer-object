<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Reader;

use Generator;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\FileReaderProgressTransfer;
use Picamator\TransferObject\Shared\Exception\FileReaderException;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;
use Picamator\TransferObject\Shared\Reader\FileReaderProgress;

class FileReaderProgressTest extends TestCase
{
    private FileReaderProgress&MockObject $fileReaderProgressMock;

    private FileReaderInterface&MockObject $fileReaderMock;

    protected function setUp(): void
    {
        $this->fileReaderMock = $this->createMock(FileReaderInterface::class);

        $this->fileReaderProgressMock = $this->getMockBuilder(FileReaderProgress::class)
            ->setConstructorArgs([ $this->fileReaderMock])
            ->onlyMethods([
                'filesize',
                'fileExists',
            ])
            ->getMock();
    }

    public function testReadFile(): void
    {
        // Arrange
        $filename = 'some-path/test.txt';

        $fileLine = 'some-path/config.yml';
        $filesize = strlen($fileLine);

        $contentGenerator = function () use ($fileLine): Generator {
            yield $fileLine;
        };

        // Expect
        $this->fileReaderMock->expects($this->once())
            ->method('readFile')
            ->with($filename)
            ->willReturn($contentGenerator());

        $this->fileReaderProgressMock->expects($this->once())
            ->method('fileExists')
            ->with($filename)
            ->willReturn(true);

        $this->fileReaderProgressMock->expects($this->once())
            ->method('filesize')
            ->with($filename)
            ->willReturn($filesize);

        // Act
        $actual = $this->fileReaderProgressMock->readFile($filename)->current();

        // Assert
        $this->assertInstanceOf(FileReaderProgressTransfer::class, $actual);
        $this->assertSame($filesize, $actual->totalBytes);
        $this->assertSame($filesize, $actual->progressBytes);
        $this->assertSame($fileLine, $actual->content);
    }

    #[TestWith([0])]
    #[TestWith([false])]
    public function testEmptyFileShouldThrowException(int|false $filesize): void
    {
        // Arrange
        $filename = 'some-path/test.txt';

        // Expect
        $this->fileReaderMock->expects($this->never())
            ->method('readFile');

        $this->fileReaderProgressMock->expects($this->once())
            ->method('fileExists')
            ->with($filename)
            ->willReturn(true);

        $this->fileReaderProgressMock->expects($this->once())
            ->method('filesize')
            ->with($filename)
            ->willReturn($filesize);

        // Expect
        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderProgressMock->readFile($filename)->current();
    }

    public function testFileNotExistShouldThrowException(): void
    {
        // Arrange
        $filename = 'some-path/test.txt';

        // Expect
        $this->fileReaderMock->expects($this->never())
            ->method('readFile');

        $this->fileReaderProgressMock->expects($this->once())
            ->method('fileExists')
            ->with($filename)
            ->willReturn(false);

        $this->fileReaderProgressMock->expects($this->never())
            ->method('filesize');

        // Expect
        $this->expectException(FileReaderException::class);

        // Act
        $this->fileReaderProgressMock->readFile($filename)->current();
    }
}
