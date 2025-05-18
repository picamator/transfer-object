<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder\Expander;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Enum\GetTypeEnum;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\BuilderExpanderInterface;
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\TransferTypeBuilderExpander;
use ReflectionMethod;

class TransferTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private ReflectionMethod $isApplicableReflection;

    private BuilderContentInterface&Stub $builderContentStub;

    protected function setUp(): void
    {
        $this->builderContentStub = $this->createStub(BuilderContentInterface::class);

        $this->expander = new TransferTypeBuilderExpander();

        $this->isApplicableReflection = new ReflectionMethod(
            TransferTypeBuilderExpander::class,
            'isApplicable',
        );
        $this->isApplicableReflection->setAccessible(true);
    }

    /**
     * @param array<string,mixed> $propertyValue
     */
    #[DataProvider('applicableTransferTypeDataProvider')]
    public function testApplicableTransferType(GetTypeEnum $type, array $propertyValue, bool $expected): void
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
    public static function applicableTransferTypeDataProvider(): Generator
    {
        yield 'type is array and property value is an array with key valid variable name should expect true' => [
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

        yield 'type is array and property value is an array with key is invalid variable name should expect false' => [
            'type' => GetTypeEnum::array,
            'propertyValue' => [
                '2024-12-26' => ['sku' => 123],
            ],
            'expected' => false,
        ];
    }
}
