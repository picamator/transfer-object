<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator\Processor\Command;

use ArrayObject;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\CacheFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder\TransferGeneratorBuilder;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommand;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\Processor\Command\PostProcessCommandInterface;

#[Group('transfer-generator')]
final class PostProcessCommandTest extends TestCase
{
    private PostProcessCommandInterface $command;

    private GeneratorFilesystemInterface&Stub $filesystemStub;

    private CacheFilesystemInterface&MockObject $cacheFilesystemMock;

    protected function setUp(): void
    {
        $builder = new TransferGeneratorBuilder();

        $this->filesystemStub = $this->createStub(GeneratorFilesystemInterface::class);
        $this->cacheFilesystemMock = $this->createMock(CacheFilesystemInterface::class);

        $this->command = new PostProcessCommand(
            $builder,
            $this->cacheFilesystemMock,
            $this->filesystemStub,
        );
    }

    #[TestDox('Filesystem exception should be handled on postProcessSuccess')]
    public function testFilesystemExceptionShouldBeHandledOnPostProcessSuccess(): void
    {
        // Arrange
        $tempCache = new ArrayObject([
            'className' => 'some-hash',
        ]);

        $cache = new ArrayObject([
            'className' => 'some-hash',
            'classNameToDelete' => 'some-hash',
        ]);


        $this->filesystemStub
            ->method('rotateTempDir')
            ->willThrowException(new FilesystemException())
            ->seal();

        // Expect
        $this->cacheFilesystemMock->expects($this->once())
            ->method('closeTempCache');

        $this->cacheFilesystemMock->expects($this->once())
            ->method('readFromTempCache')
            ->willReturn($tempCache);

        $this->cacheFilesystemMock->expects($this->once())
            ->method('readFromCache')
            ->willReturn($cache)
            ->seal();

        // Act
        $actual = $this->command->postProcess(true);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    #[TestDox('Filesystem exception should be handled on PostProcessError')]
    public function testFilesystemExceptionShouldBeHandledOnPostProcessError(): void
    {
        // Arrange
        $this->filesystemStub
            ->method('deleteTempDir')
            ->willThrowException(new FilesystemException())
            ->seal();

        // Expect
        $this->cacheFilesystemMock->expects($this->once())
            ->method('closeTempCache')
            ->seal();

        // Act
        $actual = $this->command->postProcess(false);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }
}
