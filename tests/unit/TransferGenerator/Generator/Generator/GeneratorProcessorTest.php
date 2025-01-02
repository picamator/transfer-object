<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ConfigValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class GeneratorProcessorTest extends TestCase
{
    private GeneratorProcessorInterface $generatorProcessor;

    private ConfigLoaderInterface&MockObject $configLoaderMock;

    private GeneratorFilesystemInterface&MockObject $filesystemMock;

    protected function setUp(): void
    {
        $this->configLoaderMock = $this->createMock(ConfigLoaderInterface::class);

        $builder = new TransferGeneratorBuilder();

        $renderMock = $this->createMock(TemplateRenderInterface::class);

        $this->filesystemMock = $this->createMock(GeneratorFilesystemInterface::class);

        $this->generatorProcessor = new GeneratorProcessor(
            $this->configLoaderMock,
            $builder,
            $renderMock,
            $this->filesystemMock,
        );
    }

    public function testFilesystemExceptionShouldBeHandledOnPreProcess(): void
    {
        // Arrange
        $configPath = 'some-config-path.config.yml';

        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = new ConfigValidatorTransfer();
        $configTransfer->validator->isValid = true;

        $this->configLoaderMock->expects($this->once())
            ->method('loadConfig')
            ->with($configPath)
            ->willReturn($configTransfer);

        $this->filesystemMock->expects($this->once())
            ->method('createTempDir')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->generatorProcessor->preProcess($configPath);

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
