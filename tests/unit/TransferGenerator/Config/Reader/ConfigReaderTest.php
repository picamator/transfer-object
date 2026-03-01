<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Config\Reader;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Generated\ConfigContentTransfer;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\Builder\ConfigBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReader;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;

#[Group('transfer-generator')]
final class ConfigReaderTest extends TestCase
{
    private ConfigReaderInterface $configReader;

    private ConfigValidatorInterface&MockObject $validatorMock;

    private ConfigParserInterface&MockObject $parserMock;

    private ConfigBuilderInterface&MockObject $builderMock;

    protected function setUp(): void
    {
        $this->validatorMock = $this->createMock(ConfigValidatorInterface::class);
        $this->parserMock = $this->createMock(ConfigParserInterface::class);
        $this->builderMock = $this->createMock(ConfigBuilderInterface::class);

        $this->configReader = new ConfigReader(
            $this->validatorMock,
            $this->parserMock,
            $this->builderMock,
        );
    }

    #[TestDox('Validate file throws exception should return false')]
    public function testValidateFileThrowsExceptionShouldReturnFalse(): void
    {
        // Arrange
        $configPath = 'some-config-path.config.yml';
        $expectedConfigTransfer = $this->createInvalidConfigTransfer();

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('validateFile')
            ->with($configPath)
            ->willThrowException(new FilesystemException());

        $this->validatorMock->expects($this->never())
            ->method('validateContent')
            ->with($configPath)
            ->seal();

        $this->parserMock->expects($this->never())
            ->method('parseConfig')
            ->seal();

        $this->builderMock->expects($this->once())
            ->method('createErrorConfigTransfer')
            ->willReturn($expectedConfigTransfer)
            ->seal();

        // Act
        $actual = $this->configReader->getConfig($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    #[TestDox('Validate content throws exception should return false')]
    public function testValidateContentThrowsExceptionShouldReturnFalse(): void
    {
        // Arrange
        $configPath = 'some-config-path.config.yml';
        $expectedConfigTransfer = $this->createInvalidConfigTransfer();

        $contentTransfer = new ConfigContentTransfer();

        $fileValidatorTransfer = new ValidatorTransfer([
            ValidatorTransfer::IS_VALID_PROP => true,
        ]);

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('validateFile')
            ->with($configPath)
            ->willReturn($fileValidatorTransfer);

        $this->validatorMock->expects($this->once())
            ->method('validateContent')
            ->willThrowException(new FilesystemException())
            ->seal();

        $this->parserMock->expects($this->once())
            ->method('parseConfig')
            ->willReturn($contentTransfer)
            ->seal();

        $this->builderMock->expects($this->once())
            ->method('createErrorConfigTransfer')
            ->willReturn($expectedConfigTransfer)
            ->seal();

        // Act
        $actual = $this->configReader->getConfig($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    private function createInvalidConfigTransfer(): ConfigTransfer
    {
        return new ConfigTransfer([
            ConfigTransfer::VALIDATOR_PROP => [
                ValidatorTransfer::IS_VALID_PROP => false,
            ],
        ]);
    }
}
