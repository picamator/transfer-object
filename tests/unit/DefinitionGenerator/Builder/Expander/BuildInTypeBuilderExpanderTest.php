<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder\Expander;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuildInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use stdClass;

class BuildInTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private BuilderContentInterface&MockObject $builderContentMock;

    protected function setUp(): void
    {
        $this->builderContentMock = $this->createMock(BuilderContentInterface::class);

        $this->expander = new BuildInTypeBuilderExpander();
    }

    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $getTypeEnum = GetTypeEnum::object;
        $propertyValue = new stdClass();
        $propertyName = 'someObject';

        $builderTransfer = new DefinitionBuilderTransfer();

        $this->builderContentMock->expects($this->atLeastOnce())
            ->method('getType')
            ->willReturn($getTypeEnum);

        $this->builderContentMock->expects($this->atLeastOnce())
            ->method('getPropertyValue')
            ->willReturn($propertyValue);

        $this->builderContentMock->expects($this->atLeastOnce())
            ->method('getPropertyName')
            ->willReturn($propertyName);

        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->expander->expandBuilderTransfer($this->builderContentMock, $builderTransfer);
    }
}
