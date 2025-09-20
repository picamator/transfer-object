<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Content\Expander;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuildInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use stdClass;

#[Group('definition-generator')]
class BuildInTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private ContentInterface&Stub $builderContentStub;

    protected function setUp(): void
    {
        $this->builderContentStub = $this->createStub(ContentInterface::class);

        $this->expander = new BuildInTypeBuilderExpander();
    }

    #[TestDox('Unsupported type should throw exception')]
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
