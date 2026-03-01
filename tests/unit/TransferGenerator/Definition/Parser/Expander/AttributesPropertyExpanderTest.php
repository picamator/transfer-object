<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Expander;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\AttributesPropertyExpander;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilderInterface;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\PropertyExpanderInterface;

#[Group('transfer-generator')]
final class AttributesPropertyExpanderTest extends TestCase
{
    private PropertyExpanderInterface $expander;

    private NamespaceBuilderInterface&MockObject $namespaceBuilderMock;

    protected function setUp(): void
    {
        $this->namespaceBuilderMock = $this->createMock(NamespaceBuilderInterface::class);

        $this->expander = new AttributesPropertyExpander($this->namespaceBuilderMock);
    }

    #[TestDox('Attribute regex failed to parse should skip attribute')]
    public function testAttributeRegexFailedToParseShouldSkipAttribute(): void
    {
        // Arrange
        $propertyType = [
            'attributes' => [''],
        ];

        $propertyTransfer = new DefinitionPropertyTransfer();

        // Expect
        $this->namespaceBuilderMock->expects($this->never())
            ->method('createNamespaceTransfer')
            ->seal();

        // Act
        $this->expander->expandPropertyTransfer($propertyType, $propertyTransfer);

        // Assert
        $this->assertEmpty($propertyTransfer->attributes);
    }
}
