<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class GeneratorProcessorTest extends TestCase
{
    private GeneratorProcessorInterface $generatorProcessor;

    private TemplateRenderInterface&MockObject $renderMock;

    private GeneratorFilesystemInterface&MockObject $filesystemMock;

    protected function setUp(): void
    {
        $this->renderMock = $this->createMock(TemplateRenderInterface::class);

        $this->filesystemMock = $this->createMock(GeneratorFilesystemInterface::class);

        $this->generatorProcessor = new GeneratorProcessor(
            $this->renderMock,
            $this->filesystemMock,
        );
    }

    public function testFilesystemExceptionShouldBeHandledOnPreProcess(): void
    {
        // Arrange
        $this->filesystemMock->expects($this->once())
            ->method('createTempDir')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->generatorProcessor->preProcess();

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    public function testFilesystemExceptionShouldBeHandledOnPostProcessSuccess(): void
    {
        // Arrange
        $this->filesystemMock->expects($this->once())
            ->method('rotateTempDir')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->generatorProcessor->postProcessSuccess();

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    public function testFilesystemExceptionShouldBeHandledOnPostProcessError(): void
    {
        // Arrange
        $this->filesystemMock->expects($this->once())
            ->method('deleteTempDir')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->generatorProcessor->postProcessError();

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }
}
