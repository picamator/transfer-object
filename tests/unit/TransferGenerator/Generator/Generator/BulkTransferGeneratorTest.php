<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionValidatorTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\BulkTransferGenerator;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\BulkTransferGeneratorInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorInterface;

class BulkTransferGeneratorTest extends TestCase
{
    private BulkTransferGeneratorInterface $bulkGenerator;

    private TransferGeneratorInterface&MockObject $generatorMock;

    protected function setUp(): void
    {
        $this->generatorMock = $this->createMock(TransferGeneratorInterface::class);

        $this->bulkGenerator = new BulkTransferGenerator($this->generatorMock);
    }

    public function testGeneratorIteratesInvalidItemShouldRiseException(): void
    {
        // Arrange
        $generatorTransfer = $this->createErrorGeneratorTransfer();

        $this->generatorMock->expects($this->exactly(2))
            ->method('getTransferGenerator')
            ->willReturnCallback(fn() => yield $generatorTransfer);

        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->bulkGenerator->generateTransfers();
    }

    private function createErrorGeneratorTransfer(): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->validator = new DefinitionValidatorTransfer();
        $generatorTransfer->validator->isValid = false;

        return $generatorTransfer;
    }
}
