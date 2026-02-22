<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\AttributesNamespaceBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilderInterface;

#[Group('transfer-generator')]
final class AttributesNamespaceBuilderTest extends TestCase
{
    private NamespaceBuilderInterface $builder;

    private NamespaceBuilderInterface&MockObject $namespaceBuilderMock;

    protected function setUp(): void
    {
        $this->namespaceBuilderMock = $this->createMock(NamespaceBuilderInterface::class);

        $this->builder = new AttributesNamespaceBuilder($this->namespaceBuilderMock);
    }

    #[TestDox('Create Attribute Namespace replacing shortcuts $namespace to $expected')]
    #[TestWith(['sf-assert:NotBlank', 'Symfony\Component\Validator\Constraints\NotBlank'])]
    #[TestWith(['sf-assert:  NotBlank', 'Symfony\Component\Validator\Constraints\NotBlank'])]
    #[TestWith(['NotBlank', 'NotBlank'])]
    public function testCreateNamespaceTransfer(string $namespace, string $expected): void
    {
        // Arrange
        $namespaceTransfer = new DefinitionNamespaceTransfer();

        // Expect
        $this->namespaceBuilderMock->expects($this->once())
            ->method('createNamespaceTransfer')
            ->with($expected)
            ->willReturn($namespaceTransfer)
            ->seal();

        // Act
        $this->builder->createNamespaceTransfer($namespace);
    }
}
