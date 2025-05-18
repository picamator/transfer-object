<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessor;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\GeneratorProcessorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateRenderInterface;

class GeneratorProcessorTest extends TestCase
{
    private GeneratorProcessorInterface $generatorProcessor;

    private ConfigLoaderInterface&Stub $configLoaderStub;

    private GeneratorFilesystemInterface&Stub $filesystemStub;

    protected function setUp(): void
    {
        $this->configLoaderStub = $this->createStub(ConfigLoaderInterface::class);

        $builder = new TransferGeneratorBuilder();

        $renderStub = $this->createStub(TemplateRenderInterface::class);

        $this->filesystemStub = $this->createStub(GeneratorFilesystemInterface::class);

        $this->generatorProcessor = new GeneratorProcessor(
            $this->configLoaderStub,
            $builder,
            $renderStub,
            $this->filesystemStub,
        );
    }

    public function testFilesystemExceptionShouldBeHandledOnPreProcess(): void
    {
        // Arrange
        $configPath = 'some-config-path.config.yml';

        $configTransfer = new ConfigTransfer();
        $configTransfer->validator = new ValidatorTransfer();
        $configTransfer->validator->isValid = true;

        $this->configLoaderStub
            ->method('loadConfig')
            ->with($configPath)
            ->willReturn($configTransfer);

        $this->filesystemStub
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
        $this->filesystemStub
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
        $this->filesystemStub
            ->method('deleteTempDir')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->generatorProcessor->postProcessError();

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }
}
