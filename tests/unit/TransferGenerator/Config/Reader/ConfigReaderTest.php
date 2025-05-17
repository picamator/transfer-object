<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Config\Reader;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Dependency\Exception\FilesystemException;
use Picamator\TransferObject\Dependency\Exception\YmlParserException;
use Picamator\TransferObject\Generated\ValidatorTransfer;
use Picamator\TransferObject\TransferGenerator\Config\Parser\ConfigParserInterface;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReader;
use Picamator\TransferObject\TransferGenerator\Config\Reader\ConfigReaderInterface;
use Picamator\TransferObject\TransferGenerator\Config\Validator\ConfigValidatorInterface;

class ConfigReaderTest extends TestCase
{
    private ConfigReaderInterface $reader;

    private ConfigParserInterface&MockObject $parserMock;

    private ConfigValidatorInterface&MockObject $validatorMock;

    protected function setUp(): void
    {
        $this->parserMock = $this->createMock(ConfigParserInterface::class);

        $this->validatorMock = $this->createMock(ConfigValidatorInterface::class);

        $this->reader = new ConfigReader(
            $this->parserMock,
            $this->validatorMock,
        );
    }

    public function testShouldCatchFileSystemExceptionOnGetConfig(): void
    {
        // Arrange
        $configPath = 'some-config-path.yml';

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('validateFile')
            ->willThrowException(new FilesystemException());

        // Act
        $actual = $this->reader->getConfig($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }

    public function testShouldCatchYmlParserExceptionOnGetConfig(): void
    {
        // Arrange
        $configPath = 'some-config-path.yml';

        $validatorTransfer = new ValidatorTransfer();
        $validatorTransfer->isValid = true;

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('validateFile')
            ->willReturn($validatorTransfer);

        $this->parserMock->expects($this->once())
            ->method('parseConfig')
            ->willThrowException(new YmlParserException());

        // Act
        $actual = $this->reader->getConfig($configPath);

        // Assert
        $this->assertFalse($actual->validator->isValid);
    }
}
