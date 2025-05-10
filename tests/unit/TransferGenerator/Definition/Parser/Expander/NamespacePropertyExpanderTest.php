<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Definition\Parser\Expander;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\DefinitionNamespaceTransfer;
use Picamator\TransferObject\TransferGenerator\Definition\Parser\Expander\NamespacePropertyExpanderTrait;

class NamespacePropertyExpanderTest extends TestCase
{
    private NamespacePropertyExpanderInterface $expander;

    protected function setUp(): void
    {
        $this->expander = new class () implements NamespacePropertyExpanderInterface
        {
            use NamespacePropertyExpanderTrait {
                createDefinitionNamespaceTransfer as public;
                isNamespace as public;
            }
        };
    }

    #[TestWith(['\Picamator\TransferObject\Generated\ConfigContentTransfer', true])]
    #[TestWith(['\ConfigContentTransfer', true])]
    #[TestWith(['ConfigContentTransfer', false])]
    public function testIsNamespace(string $namespace, bool $expected): void
    {
        // Act
        $actual = $this->expander->isNamespace($namespace);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @param array<string,mixed> $expected
     */
    #[DataProvider('definitionNamespaceDataProvider')]
    public function testCreateDefinitionNamespaceTransfer(string $namespace, array $expected): void
    {
        // Act
        $actual = $this->expander->createDefinitionNamespaceTransfer($namespace);

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
