<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder\Expander;

use PHPUnit\Framework\MockObject\Stub;
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

    private BuilderContentInterface&Stub $builderContentStub;

    protected function setUp(): void
    {
        $this->builderContentStub = $this->createStub(BuilderContentInterface::class);

        $this->expander = new BuildInTypeBuilderExpander();
    }

    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $getTypeEnum = GetTypeEnum::object;
        $this->builderContentStub
            ->method('getType')
            ->willReturn($getTypeEnum);

        $propertyValue = new stdClass();
        $this->builderContentStub
            ->method('getPropertyValue')
            ->willReturn($propertyValue);

        $propertyName = 'someObject';
        $this->builderContentStub
            ->method('getPropertyName')
            ->willReturn($propertyName);

        $builderTransfer = new DefinitionBuilderTransfer();

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->expander->expandBuilderTransfer($this->builderContentStub, $builderTransfer);
    }
}
