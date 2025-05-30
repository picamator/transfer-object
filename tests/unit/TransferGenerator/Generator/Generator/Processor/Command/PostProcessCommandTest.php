<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommandInterface;

class PostProcessCommandTest extends TestCase
{
    private PostProcessCommandInterface $command;

    private GeneratorFilesystemInterface&Stub $filesystemStub;

    protected function setUp(): void
    {
        $builder = new TransferGeneratorBuilder();

        $this->filesystemStub = $this->createStub(GeneratorFilesystemInterface::class);

        $this->command = new PostProcessCommand(
            $builder,
            $this->filesystemStub,
        );
    }

    public function testFilesystemExceptionShouldBeHandledOnPostProcessSuccess(): void
    {
        // Arrange
        $this->filesystemStub
            ->method('rotateTempDir')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->command->postProcess(true);

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
        $actual = $this->command->postProcess(false);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }
}
