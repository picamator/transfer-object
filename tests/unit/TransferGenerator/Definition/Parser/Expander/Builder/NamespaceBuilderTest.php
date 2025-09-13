<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilderInterface;

#[Group('transfer-generator')]
class NamespaceBuilderTest extends TestCase
{
    private NamespaceBuilderInterface $builder;

    protected function setUp(): void
    {
        $this->builder = new NamespaceBuilder();
    }

    /**
     * @param array<string,mixed> $expected
     */
    #[DataProvider('definitionNamespaceDataProvider')]
    public function testCreateDefinitionNamespaceTransfer(string $namespace, array $expected): void
    {
        // Act
        $actual = $this->builder->createNamespaceTransfer($namespace);

        // Assert
        $this->assertEquals($expected, $actual->toArray());
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function definitionNamespaceDataProvider(): Generator
    {
        yield 'namespace without alias' => [
            '\Picamator\TransferObject\Generated',
            [
                DefinitionNamespaceTransfer::FULL_NAME => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME => 'Generated',
                DefinitionNamespaceTransfer::ALIAS => null,
            ],
        ];

        yield 'namespace with as lowercase' => [
            '\Picamator\TransferObject\Generated as GeneratedAlias',
            [
                DefinitionNamespaceTransfer::FULL_NAME => '\Picamator\TransferObject\Generated as GeneratedAlias',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME => 'Generated',
                DefinitionNamespaceTransfer::ALIAS => 'GeneratedAlias',
            ],
        ];

        yield 'namespace with AS upper case' => [
            '\Picamator\TransferObject\Generated AS GeneratedAlias',
            [
                DefinitionNamespaceTransfer::FULL_NAME => '\Picamator\TransferObject\Generated as GeneratedAlias',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME => 'Generated',
                DefinitionNamespaceTransfer::ALIAS => 'GeneratedAlias',
            ],
        ];

        yield 'namespace with AS upper case and multiple spaces' => [
            '\Picamator\TransferObject\Generated    AS    GeneratedAlias',
            [
                DefinitionNamespaceTransfer::FULL_NAME => '\Picamator\TransferObject\Generated as GeneratedAlias',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME => 'Generated',
                DefinitionNamespaceTransfer::ALIAS => 'GeneratedAlias',
            ],
        ];

        yield 'root namespace' => [
            'DateTime',
            [
                DefinitionNamespaceTransfer::FULL_NAME => 'DateTime',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS => 'DateTime',
                DefinitionNamespaceTransfer::BASE_NAME => 'DateTime',
                DefinitionNamespaceTransfer::ALIAS => null,
            ],
        ];
    }
}
