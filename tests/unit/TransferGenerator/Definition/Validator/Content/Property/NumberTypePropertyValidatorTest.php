<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Validator\Content\Property;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\RequiresPhpExtension;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\NumberTypePropertyValidator;
use Picamator\TransferObject\TransferGenerator\Definition\Validator\Content\Property\PropertyValidatorInterface;

#[Group('transfer-generator')]
class NumberTypePropertyValidatorTest extends TestCase
{
    private PropertyValidatorInterface&MockObject $validatorMock;

    protected function setUp(): void
    {
        $this->validatorMock = $this->getMockBuilder(NumberTypePropertyValidator::class)
            ->onlyMethods(['isBcMathLoaded'])
            ->getMock();
    }

    public function testBcMathWasNotLoadedShouldReturnError(): void
    {
        // Arrange
        $propertyTransfer = new DefinitionPropertyTransfer();

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('isBcMathLoaded')
            ->willReturn(false);

        // Act
        $actual = $this->validatorMock->validate($propertyTransfer);

        // Assert
        $this->assertFalse($actual->isValid);
        $this->assertStringContainsString('PHP extension BCMath was not loaded', $actual->errorMessage);
    }

    #[RequiresPhpExtension('bcmath')]
    public function testInvalidBcMathTypeShouldReturnError(): void
    {
        // Arrange
        $namespaceTransfer = new DefinitionNamespaceTransfer();
        $namespaceTransfer->withoutAlias = 'SomeClassName';

        $embeddedTypeTransfer = new DefinitionEmbeddedTypeTransfer();
        $embeddedTypeTransfer->namespace = $namespaceTransfer;
        $embeddedTypeTransfer->name = 'SomeClassName';

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = 'someName';
        $propertyTransfer->numberType = $embeddedTypeTransfer;

        // Expect
        $this->validatorMock->expects($this->once())
            ->method('isBcMathLoaded')
            ->willReturn(true);

        // Act
        $actual = $this->validatorMock->validate($propertyTransfer);

        // Assert
        $this->assertFalse($actual->isValid);
        $this->assertStringContainsString('is not a BcMath\Number', $actual->errorMessage);
    }
}
