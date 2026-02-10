<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilder;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\Builder\NamespaceBuilderInterface;

#[Group('transfer-generator')]
final class NamespaceBuilderTest extends TestCase
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
    #[TestDoxFormatter('definitionNamespaceTestDoxFormatter')]
    public function testCreateDefinitionNamespaceTransfer(string $namespace, array $expected): void
    {
        // Act
        $actual = $this->builder->createNamespaceTransfer($namespace);

        // Assert
        $this->assertArraysAreEqual($expected, $actual->toArray());
    }

    /**
     * @param array<string,mixed> $expected
     */
    public static function definitionNamespaceTestDoxFormatter(string $namespace, array $expected): string
    {
        return sprintf(
            'Definition namespace "%s" expected "%s"',
            $namespace,
            json_encode($expected),
        );
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function definitionNamespaceDataProvider(): Generator
    {
        yield 'namespace without alias' => [
            '\Picamator\TransferObject\Generated',
            [
                DefinitionNamespaceTransfer::FULL_NAME_PROP => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS_PROP => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME_PROP => 'Generated',
                DefinitionNamespaceTransfer::ALIAS_PROP => null,
            ],
        ];

        yield 'namespace with as lowercase' => [
            '\Picamator\TransferObject\Generated as GeneratedAlias',
            [
                DefinitionNamespaceTransfer::FULL_NAME_PROP => '\Picamator\TransferObject\Generated as GeneratedAlias',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS_PROP => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME_PROP => 'Generated',
                DefinitionNamespaceTransfer::ALIAS_PROP => 'GeneratedAlias',
            ],
        ];

        yield 'namespace with AS upper case' => [
            '\Picamator\TransferObject\Generated AS GeneratedAlias',
            [
                DefinitionNamespaceTransfer::FULL_NAME_PROP => '\Picamator\TransferObject\Generated as GeneratedAlias',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS_PROP => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME_PROP => 'Generated',
                DefinitionNamespaceTransfer::ALIAS_PROP => 'GeneratedAlias',
            ],
        ];

        yield 'namespace with AS upper case and multiple spaces' => [
            '\Picamator\TransferObject\Generated    AS    GeneratedAlias',
            [
                DefinitionNamespaceTransfer::FULL_NAME_PROP => '\Picamator\TransferObject\Generated as GeneratedAlias',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS_PROP => '\Picamator\TransferObject\Generated',
                DefinitionNamespaceTransfer::BASE_NAME_PROP => 'Generated',
                DefinitionNamespaceTransfer::ALIAS_PROP => 'GeneratedAlias',
            ],
        ];

        yield 'root namespace' => [
            'DateTime',
            [
                DefinitionNamespaceTransfer::FULL_NAME_PROP => 'DateTime',
                DefinitionNamespaceTransfer::WITHOUT_ALIAS_PROP => 'DateTime',
                DefinitionNamespaceTransfer::BASE_NAME_PROP => 'DateTime',
                DefinitionNamespaceTransfer::ALIAS_PROP => null,
            ],
        ];
    }
}
