<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Filesystem;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Filesystem\FilesystemInterface;
use Picamator\TransferObject\Dependency\Finder\FinderInterface;
use Picamator\TransferObject\Generated\TransferGeneratorContentTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Config\ConfigInterface;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystem;
use Picamator\TransferObject\TransferGenerator\Generator\Filesystem\GeneratorFilesystemInterface;

#[Group('transfer-generator')]
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

    #[TestDox('Duplicate file write should throw exception')]
    public function testDuplicateFileWriteShouldThrowException(): void
    {
        // Arrange
        $contentTransfer = new TransferGeneratorContentTransfer([
            TransferGeneratorContentTransfer::CLASS_NAME_PROP => 'CustomerTransfer',
            TransferGeneratorContentTransfer::CONTENT_PROP => 'class TestTransfer {}',
        ]);

        $transferPath = 'some-path';

        $this->configStub
            ->method('getTransferPath')
            ->willReturn($transferPath)
            ->seal();

        $this->filesystemStub
            ->method('exists')
            ->willReturn(true)
            ->seal();

        // Expect
        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->generatorFilesystem->writeFile($contentTransfer);
    }
}
