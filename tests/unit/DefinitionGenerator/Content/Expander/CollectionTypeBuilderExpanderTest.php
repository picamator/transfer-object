<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Content\Expander;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDoxFormatterExternal;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\CollectionTypeBuilderExpander;
use ReflectionMethod;

#[Group('definition-generator')]
class CollectionTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private ReflectionMethod $isApplicableReflection;

    private ContentInterface&Stub $builderContentStub;

    protected function setUp(): void
    {
        $this->builderContentStub = $this->createStub(ContentInterface::class);

        $this->expander = new CollectionTypeBuilderExpander();

        $this->isApplicableReflection = new ReflectionMethod(
            CollectionTypeBuilderExpander::class,
            'isApplicable',
        );
    }

    /**
     * @param array<string,mixed> $propertyValue
     */
    #[DataProvider('applicableCollectionTypeDataProvider')]
    #[TestDoxFormatterExternal(ExpanderTestDoxFormatter::class, 'applicableTransferTypeFormatter')]
    public function testApplicableCollectionType(GetTypeEnum $type, array $propertyValue, bool $expected): void
    {
        // Arrange
        $this->builderContentStub
            ->method('getType')
            ->willReturn($type);

        $this->builderContentStub
            ->method('getPropertyValue')
            ->willReturn($propertyValue);

        // Act
        $actual = $this->isApplicableReflection->invoke($this->expander, $this->builderContentStub);

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

        yield 'type is array and property values is an associative array of mixed types should expect false' => [
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
