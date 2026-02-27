<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Hash;

use ArrayObject;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Shared\Hash\HashFileWriter;
use Picamator\TransferObject\Shared\Hash\HashFileWriterInterface;

#[Group('shared')]
final class HashFileWriterTest extends TestCase
{
    private HashFileWriterInterface $writer;

    private FilesystemInterface&MockObject $filesystemMock;

    protected function setUp(): void
    {
        $this->filesystemMock = $this->createMock(FilesystemInterface::class);

        $this->writer = new HashFileWriter($this->filesystemMock);
    }

    #[TestDox('Write hash file data')]
    public function testWriteFile(): void
    {
        // Arrange
        $path = '/some/path';
        $data = new ArrayObject([
            'CustomerTransfer' => 'some-hash',
        ]);

        $expected = 'CustomerTransfer,some-hash';

        // Expect
        $this->filesystemMock
            ->expects($this->once())
            ->method('dumpFile')
            ->with($path, $expected)
            ->seal();

        // Act
        $this->writer->writeFile($path, $data);
    }
}
