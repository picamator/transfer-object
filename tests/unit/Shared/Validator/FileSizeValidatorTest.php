<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\Shared\Validator;

use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Shared\Environment\EnvironmentReaderInterface;
use Picamator\TransferObject\Shared\Validator\FileSizeValidator;

final class FileSizeValidatorTest extends TestCase
{
    private const int MAX_FILE_SIZE_BYTES = 10;

    private FileSizeValidator&MockObject $validatorMock;

    protected function setUp(): void
    {
        $environmentReaderStub = $this->createStub(EnvironmentReaderInterface::class);
        $environmentReaderStub
            ->method('getMaxFileSizeBytes')
            ->willReturn(self::MAX_FILE_SIZE_BYTES)
            ->seal();

        $this->validatorMock = $this->getMockBuilder(FileSizeValidator::class)
            ->setConstructorArgs([$environmentReaderStub])
            ->onlyMethods(['filesize'])
            ->getMock();
    }

    #[TestDox('Unknown file size')]
    public function testUnknownFileSize(): void
    {
        // Arrange
        $path = '/some-path.txt';

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('filesize')
            ->with($path)
            ->willReturn(false)
            ->seal();

        // Act
        $actual = $this->validatorMock->validate($path);

        // Assert
        $this->assertNotNull($actual);
        $this->assertStringContainsString('Failed to get file size', $actual->errorMessage);
    }

    #[TestDox('Max file size exceeded')]
    public function testMaxFileSizeExceeded(): void
    {
        // Arrange
        $path = '/some-path.txt';
        $fileSize = self::MAX_FILE_SIZE_BYTES + 1;

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('filesize')
            ->with($path)
            ->willReturn($fileSize)
            ->seal();

        // Act
        $actual = $this->validatorMock->validate($path);

        // Assert
        $this->assertNotNull($actual);
        $this->assertStringContainsString('exceeds the maximum allowed size', $actual->errorMessage);
    }
}
