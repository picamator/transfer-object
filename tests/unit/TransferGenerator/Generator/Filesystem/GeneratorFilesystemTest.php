<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Filesystem;

use PHPUnit\Framework\MockObject\MockObject;
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

    private FilesystemInterface&MockObject $filesystemMock;

    private ConfigInterface&MockObject $configMock;

    protected function setUp(): void
    {
        $this->filesystemMock = $this->createMock(FilesystemInterface::class);
        $finderMock = $this->createMock(FinderInterface::class);
        $this->configMock = $this->createMock(ConfigInterface::class);

        $this->generatorFilesystem = new GeneratorFilesystem(
            $this->filesystemMock,
            $finderMock,
            $this->configMock,
        );
    }

    public function testDuplicationFileWriteShouldRiseException(): void
    {
        // Arrange
        $className = 'TestTransfer';
        $content = 'class TestTransfer {}';

        $transferPath = 'some-path';

        // Expect
        $this->configMock->expects($this->once())
            ->method('getTransferPath')
            ->willReturn($transferPath);

        $this->filesystemMock->expects($this->once())
            ->method('exists')
            ->willReturn(true);

        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->generatorFilesystem->writeFile($className, $content);
    }
}
