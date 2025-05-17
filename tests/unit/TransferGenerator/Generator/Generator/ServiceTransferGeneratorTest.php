<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorService;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorServiceInterface;
use Picamator\TransferObject\TransferGenerator\Generator\Generator\TransferGeneratorInterface;

class ServiceTransferGeneratorTest extends TestCase
{
    private TransferGeneratorServiceInterface $serviceGenerator;

    private TransferGeneratorInterface&MockObject $generatorMock;

    protected function setUp(): void
    {
        $this->generatorMock = $this->createMock(TransferGeneratorInterface::class);

        $this->serviceGenerator = new TransferGeneratorService($this->generatorMock);
    }

    public function testGeneratorIteratesInvalidItemShouldRiseException(): void
    {
        // Arrange
        $configPath = 'some-config-path.yml';

        $generatorTransfer = $this->createErrorGeneratorTransfer();

        // Expect
        $this->generatorMock->expects($this->once())
            ->method('generateTransfers')
            ->willReturnCallback(fn() => yield $generatorTransfer);

        $this->expectException(TransferGeneratorException::class);

        // Act
        $this->serviceGenerator->generateTransfersOrFail($configPath);
    }

    private function createErrorGeneratorTransfer(): TransferGeneratorTransfer
    {
        $generatorTransfer = new TransferGeneratorTransfer();

        $generatorTransfer->validator = new ValidatorTransfer();
        $generatorTransfer->validator->isValid = false;

        return $generatorTransfer;
    }
}
