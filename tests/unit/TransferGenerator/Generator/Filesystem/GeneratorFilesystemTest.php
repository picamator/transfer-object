<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Filesystem;

use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;

class GeneratorFilesystemTest extends TestCase
{
    private GeneratorFilesystemInterface $generatorFilesystem;

    private FilesystemInterface&Stub $filesystemStub;

    private ConfigInterface&Stub $configStub;

    protected function setUp(): void
    {
        $this->filesystemStub = $this->createStub(FilesystemInterface::class);

        $finderStub = $this->createStub(FinderInterface::class);

        $this->configStub = $this->createStub(ConfigInterface::class);

        $this->generatorFilesystem = new GeneratorFilesystem(
            $this->filesystemStub,
            $finderStub,
            $this->configStub,
        );
    }

    public function testDuplicationFileWriteShouldRiseException(): void
    {
        // Arrange
        $className = 'TestTransfer';
        $content = 'class TestTransfer {}';
        $transferPath = 'some-path';

        $this->configStub
            ->method('getTransferPath')
            ->willReturn($transferPath);

        $this->filesystemStub
            ->method('exists')
            ->willReturn(true);

        // Expect
        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->generatorFilesystem->writeFile($className, $content);
    }
}
