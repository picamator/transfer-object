<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder\Expander;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\CollectionTypeBuilderExpander;
use ReflectionMethod;

class CollectionTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private ReflectionMethod $isApplicableReflection;

    private BuilderContentInterface&MockObject $builderContentMock;

    protected function setUp(): void
    {
        $this->builderContentMock = $this->createMock(BuilderContentInterface::class);

        $this->expander = new CollectionTypeBuilderExpander();

        $this->isApplicableReflection = new ReflectionMethod(
            CollectionTypeBuilderExpander::class,
            'isApplicable',
        );
        $this->isApplicableReflection->setAccessible(true);
    }

    /**
     * @param array<string,mixed> $propertyValue
     */
    #[DataProvider('applicableCollectionTypeDataProvider')]
    public function testApplicableCollectionType(GetTypeEnum $type, array $propertyValue, bool $expected): void
    {
        // Expect
        $this->builderContentMock->expects($this->once())
            ->method('getType')
            ->willReturn($type);

        $this->builderContentMock->expects($this->any())
            ->method('getPropertyValue')
            ->willReturn($propertyValue);

        // Act
        $actual = $this->isApplicableReflection->invoke($this->expander, $this->builderContentMock);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function applicableCollectionTypeDataProvider(): Generator
    {
        yield 'type is array and property value is an array of arrays should expect true' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                ['sku' => 123],
                ['sku' => 456],
            ],
            'expected' => true,
        ];

        yield 'type is array and property values is an associative array of arrays should expect true' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                '2024-12-26' => ['sku' => 123],
                '2024-12-17' => ['sku' => 456],
            ],
            'expected' => true,
        ];

        yield 'type is not array should expect false' => [
            'type' => GetTypeEnum::string,
            'propertyValue' => [],
            'expected' => false,
        ];

        yield 'type is array with empty property value should expect false' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [],
            'expected' => false,
        ];

        // phpcs:ignore
        yield 'type is array and property values is an associative array of arrays and one integer should expect false' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                '2024-12-26' => ['sku' => 123],
                '2024-12-17' => ['sku' => 456],
                'total' => 2,
            ],
            'expected' => false,
        ];
    }
}
