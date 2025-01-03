<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorService;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorServiceInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorInterface;

class BulkTransferGeneratorTest extends TestCase
{
    private TransferGeneratorServiceInterface $bulkGenerator;

    private TransferGeneratorInterface&MockObject $generatorMock;

    protected function setUp(): void
    {
        $this->generatorMock = $this->createMock(TransferGeneratorInterface::class);

        $this->bulkGenerator = new TransferGeneratorService($this->generatorMock);
    }

    public function testGeneratorIteratesInvalidItemShouldRiseException(): void
    {
        // Arrange
        $configPath = 'some-config-path.yml';

        $generatorTransfer = $this->createErrorGeneratorTransfer();

        $this->generatorMock->expects($this->once())
            ->method('generateTransfers')
            ->willReturnCallback(fn() => yield $generatorTransfer);

        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->bulkGenerator->generateTransfersOrFail($configPath);
    }

    private function createErrorGeneratorTransfer(): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->validator = new DefinitionValidatorTransfer();
        $generatorTransfer->validator->isValid = false;

        return $generatorTransfer;
    }
}
