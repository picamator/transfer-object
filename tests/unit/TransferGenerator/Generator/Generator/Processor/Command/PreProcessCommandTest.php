<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Loader\ConfigLoaderInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PreProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PreProcessCommandInterface;

#[Group('transfer-generator')]
class PreProcessCommandTest extends TestCase
{
    private PreProcessCommandInterface $command;

    private ConfigLoaderInterface&Stub $configLoaderStub;

    private GeneratorFilesystemInterface&Stub $filesystemStub;

    protected function setUp(): void
    {
        $this->configLoaderStub = $this->createStub(ConfigLoaderInterface::class);

        $builder = new TransferGeneratorBuilder();

        $this->filesystemStub = $this->createStub(GeneratorFilesystemInterface::class);

        $this->command = new PreProcessCommand(
            $this->configLoaderStub,
            $builder,
            $this->filesystemStub,
        );
    }

    #[TestDox('Filesystem exception should be handled on command')]
    public function testFilesystemExceptionShouldBeHandledOnCommand(): void
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
        $actual = $this->command->preProcess($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }
}
