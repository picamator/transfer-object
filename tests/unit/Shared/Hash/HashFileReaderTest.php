<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Hash;

use Generator;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Filesystem\FileReaderInterface;
use Picamator\TransferObject\Shared\Hash\HashFileReader;
use Picamator\TransferObject\Shared\Hash\HashFileReaderInterface;

#[Group('shared')]
final class HashFileReaderTest extends TestCase
{
    private HashFileReaderInterface&MockObject $hashReaderMock;

    private FileReaderInterface&MockObject $filerReaderMock;

    protected function setUp(): void
    {
        $this->filerReaderMock = $this->createMock(FileReaderInterface::class);

        $this->hashReaderMock = $this->getMockBuilder(HashFileReader::class)
            ->onlyMethods(['fileExists'])
            ->setConstructorArgs([
                $this->filerReaderMock,
            ])
            ->getMock();
    }

    #[TestDox('File does not exist should return empty array')]
    public function testFileDoesNotExistShouldReturnEmptyArray(): void
    {
        // Arrange
        $path = 'some-path/test.txt';

        // Expect
        $this->hashReaderMock->expects($this->once())
            ->method('fileExists')
            ->with($path)
            ->willReturn(false)
            ->seal();

        $this->filerReaderMock->expects($this->never())
            ->method('readFile')
            ->seal();

        // Act
        $actual = $this->hashReaderMock->readFile($path);

        // Assert
        $this->assertSame([], $actual);
    }

    /**
     * @param array<string, string> $expected
     */
    #[TestDox('Hash file line "$line" is read as "$expected"')]
    #[TestWith(['', []])]
    #[TestWith(['test', []])]
    #[TestWith([',', []])]
    #[TestWith([', ', []])]
    #[TestWith([',test', []])]
    #[TestWith(['CustomerTransfer,hash-string', ['CustomerTransfer' => 'hash-string']])]
    #[TestWith(['CustomerTransfer,hash-string,some-text', ['CustomerTransfer' => 'hash-string,some-text']])]
    public function testReadFile(string $line, array $expected): void
    {
        // Arrange
        $path = 'some-path/test.txt';

        // Expect
        $this->hashReaderMock->expects($this->once())
            ->method('fileExists')
            ->with($path)
            ->willReturn(true)
            ->seal();

        $this->filerReaderMock->expects($this->once())
            ->method('readFile')
            ->with($path)
            ->willReturnCallback(function () use ($line): Generator {
                yield $line;
            })
            ->seal();

        // Act
        $actual = $this->hashReaderMock->readFile($path);

        // Assert
        $this->assertSame($expected, $actual);
    }
}
