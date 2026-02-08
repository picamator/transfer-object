<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Reader;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\Stub;
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

    private FilesystemInterface&Stub $filesystemStub;

    protected function setUp(): void
    {
        $this->filesystemStub = $this->createStub(FilesystemInterface::class);

        $this->reader = new JsonReader($this->filesystemStub);
    }

    #[TestDox('Failed getJsonContent should throw exception')]
    public function testFailedGetJsonContentShouldThrowException(): void
    {
        // Expect
        $this->filesystemStub
            ->method('readFile')
            ->willThrowException(new FilesystemException());

        $this->expectException(JsonReaderException::class);

        // Act
        $this->reader->getJsonContent(self::FILE_PATH);
    }

    #[TestDox('Successful getJsonContent')]
    public function testSuccessfulGetJsonContent(): void
    {
        // Arrange
        $jsonString = '{"test": 1}';
        $expected = ['test' => 1];

        // Expect
        $this->filesystemStub
            ->method('readFile')
            ->willReturn($jsonString);

        // Act
        $actual = $this->reader->getJsonContent(self::FILE_PATH);

        // Assert
        $this->assertSame($expected, $actual);
    }
}
