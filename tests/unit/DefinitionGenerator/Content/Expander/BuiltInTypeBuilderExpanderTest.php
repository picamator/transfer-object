<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Content\Expander;

use ArrayObject;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\Content;
use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuiltInTypeBuilderExpander;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\Generated\DefinitionBuilderTransfer;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Enum\BuiltInTypeEnum;
use stdClass;

#[Group('definition-generator')]
final class BuiltInTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    protected function setUp(): void
    {
        $this->expander = new BuiltInTypeBuilderExpander();
    }

    #[TestDox('Unsupported type should throw exception')]
    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $content = new Content(
            type: GetTypeEnum::object,
            propertyName: 'someObject',
            propertyValue: new stdClass(),
        );

        $builderTransfer = new DefinitionBuilderTransfer();

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->expander->expandBuilderTransfer($content, $builderTransfer);
    }

    #[TestDox('Array Object Type')]
    public function testArrayObjectType(): void
    {
        // Arrange
        $content = new Content(
            type: GetTypeEnum::object,
            propertyName: 'someArrayObject',
            propertyValue: new ArrayObject(['test' => 1]),
        );

        $builderTransfer = new DefinitionBuilderTransfer();
        $builderTransfer->definitionContent = new DefinitionContentTransfer();

        // Act
        $this->expander->expandBuilderTransfer($content, $builderTransfer);

        // Assert
        $this->assertCount(1, $builderTransfer->definitionContent->properties);

        /** @var \Picamator\TransferObject\Generated\DefinitionPropertyTransfer $propertyTransfer */
        $propertyTransfer = $builderTransfer->definitionContent->properties[0];
        $this->assertSame($content->propertyName, $propertyTransfer->propertyName);
        $this->assertSame(BuiltInTypeEnum::ARRAY_OBJECT, $propertyTransfer->builtInType?->name);
        $this->assertSame('', $propertyTransfer->builtInType->docBlock);
    }
}
