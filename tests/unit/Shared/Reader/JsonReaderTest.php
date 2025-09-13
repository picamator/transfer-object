<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Reader;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Shared\Exception\JsonReaderException;
use Picamator\TransferObject\Shared\Reader\JsonReader;
use Picamator\TransferObject\Shared\Reader\JsonReaderInterface;

#[Group('shared')]
class JsonReaderTest extends TestCase
{
    private const string FILE_PATH = 'test.json';

    private JsonReaderInterface $reader;

    private FilesystemInterface&MockObject $filesystemMock;

    protected function setUp(): void
    {
        $this->filesystemMock = $this->createMock(FilesystemInterface::class);

        $this->reader = new JsonReader($this->filesystemMock);
    }

    public function testFailWithExceptionGetJsonContent(): void
    {
        // Expect
        $this->filesystemMock->expects($this->once())
            ->method('readFile')
            ->with(self::FILE_PATH)
            ->willThrowException(new FilesystemException());

        $this->expectException(JsonReaderException::class);

        // Act
        $this->reader->getJsonContent(self::FILE_PATH);
    }

    public function testSuccessfulWithExceptionGetJsonContent(): void
    {
        // Arrange
        $jsonString = '{"test": 1}';
        $expected = ['test' => 1];

        // Expect
        $this->filesystemMock->expects($this->once())
            ->method('readFile')
            ->with(self::FILE_PATH)
            ->willReturn($jsonString);

        // Act
        $actual = $this->reader->getJsonContent(self::FILE_PATH);

        // Assert
        $this->assertSame($expected, $actual);
    }
}
