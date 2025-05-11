<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Generator\Builder;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilder;
use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\Generated\ValidatorMessageTransfer;
use Picamator\TransferObject\Shared\Exception\JsonReaderException;
use Picamator\TransferObject\Shared\Reader\JsonReaderInterface;
use Picamator\TransferObject\Shared\Validator\ClassNameValidatorInterface;
use Picamator\TransferObject\Shared\Validator\PathLocalValidatorInterface;

class DefinitionGeneratorBuilderTest extends TestCase
{
    private DefinitionGeneratorBuilderInterface $builder;

    private PathLocalValidatorInterface&MockObject $pathValidatorMock;

    private ClassNameValidatorInterface&MockObject $classNameValidatorMock;

    private JsonReaderInterface&MockObject $jsonReaderMock;

    protected function setUp(): void
    {
        $this->pathValidatorMock = $this->createMock(PathLocalValidatorInterface::class);
        $this->classNameValidatorMock = $this->createMock(ClassNameValidatorInterface::class);
        $this->jsonReaderMock = $this->createMock(JsonReaderInterface::class);

        $this->builder = new DefinitionGeneratorBuilder(
            $this->pathValidatorMock,
            $this->classNameValidatorMock,
            $this->jsonReaderMock,
        );
    }

    public function testDefinitionFileIsNotLocalShouldThrowException(): void
    {
        // Arrange
        $definitionPath = 'https://some-domain.io/definitions';
        $messageTransfer = $this->createInvalidMessageTransfer();

        // Expect
        $this->pathValidatorMock->expects($this->once())
            ->method('validate')
            ->with($definitionPath)
            ->willReturn($messageTransfer);

        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->setDefinitionPath($definitionPath);
    }

    public function testInvalidSetClassNameShouldThrowException(): void
    {
        // Arrange
        $className = '00Customer';
        $messageTransfer = $this->createInvalidMessageTransfer();

        // Expect
        $this->classNameValidatorMock->expects($this->once())
            ->method('validate')
            ->with($className)
            ->willReturn($messageTransfer);

        $this->expectException(DefinitionGeneratorException::class);
        $this->expectExceptionMessage($messageTransfer->errorMessage);

        // Act
        $this->builder->setClassName($className);
    }

    public function testInvalidSetJsonPathShouldThrowException(): void
    {
        // Arrange
        $jsonPath = 'invalid/path.json';
        $messageTransfer = $this->createInvalidMessageTransfer();

        // Expect
        $this->jsonReaderMock->expects($this->once())
            ->method('getJsonContent')
            ->with($jsonPath)
            ->willThrowException(new JsonReaderException($messageTransfer->errorMessage));

        $this->expectException(JsonReaderException::class);
        $this->expectExceptionMessage($messageTransfer->errorMessage);

        // Act
        $this->builder->setJsonPath($jsonPath);
    }

    private function createInvalidMessageTransfer(): ValidatorMessageTransfer
    {
        return new ValidatorMessageTransfer([
            ValidatorMessageTransfer::IS_VALID => false,
            ValidatorMessageTransfer::ERROR_MESSAGE => 'Error message',
        ]);
    }
}
