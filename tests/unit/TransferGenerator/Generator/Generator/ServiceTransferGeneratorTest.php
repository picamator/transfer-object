<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Generator;

use PHPUnit\Framework\MockObject\Stub;
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

    private TransferGeneratorInterface&Stub $generatorStub;

    protected function setUp(): void
    {
        $this->generatorStub = $this->createStub(TransferGeneratorInterface::class);

        $this->serviceGenerator = new TransferGeneratorService($this->generatorStub);
    }

    public function testGeneratorIteratesInvalidItemShouldRiseException(): void
    {
        // Arrange
        $configPath = 'some-config-path.yml';
        $generatorTransfer = $this->createErrorGeneratorTransfer();

        $this->generatorStub
            ->method('generateTransfers')
            ->willReturnCallback(fn() => yield $generatorTransfer);

        // Expect
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
