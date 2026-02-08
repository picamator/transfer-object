<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Content\Expander;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDoxFormatterExternal;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\Content;
use Picamator\TransferObject\DefinitionGenerator\Content\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Content\Expander\TransferTypeBuilderExpander;
use ReflectionMethod;

#[Group('definition-generator')]
class TransferTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private ReflectionMethod $isApplicableReflection;

    protected function setUp(): void
    {
        $this->expander = new TransferTypeBuilderExpander();

        $this->isApplicableReflection = new ReflectionMethod(
            TransferTypeBuilderExpander::class,
            'isApplicable',
        );
    }

    /**
     * @param array<string,mixed> $propertyValue
     */
    #[DataProvider('applicableTransferTypeDataProvider')]
    #[TestDoxFormatterExternal(ExpanderTestDoxFormatter::class, 'applicableTransferTypeFormatter')]
    public function testApplicableTransferType(GetTypeEnum $type, array $propertyValue, bool $expected): void
    {
        // Arrange
        $content = new Content(
            type: $type,
            propertyName: 'someObject',
            propertyValue: $propertyValue,
        );

        // Act
        $actual = $this->isApplicableReflection->invoke($this->expander, $content);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function applicableTransferTypeDataProvider(): Generator
    {
        yield 'type is array and property value is an array with a valid variable name key should expect true' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                'product' => ['sku' => 123],
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

        yield 'type is array and property value is an array with key an integer should expect false' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                ['sku' => 123],
            ],
            'expected' => false,
        ];

        yield 'type is array and property value is an array with an invalid variable name key should expect false' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                '2024-12-26' => ['sku' => 123],
            ],
            'expected' => false,
        ];
    }
}
