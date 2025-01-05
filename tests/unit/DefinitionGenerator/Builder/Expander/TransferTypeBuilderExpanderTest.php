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
use Picamator\TransferObject\DefinitionGenerator\Builder\Expander\TransferTypeBuilderExpander;

class TransferTypeBuilderExpanderTest extends TestCase
{
    private BuilderExpanderInterface $expander;

    private BuilderContentInterface&MockObject $builderContentMock;

    protected function setUp(): void
    {
        $this->builderContentMock = $this->createMock(BuilderContentInterface::class);

        $this->expander = new TransferTypeBuilderExpander();
    }

    /**
     * @param array<string,mixed> $propertyValue
     */
    #[DataProvider('applicableTransferTypeDataProvider')]
    public function testApplicableTransferType(GetTypeEnum $type, array $propertyValue, bool $expected): void
    {
        // Expect
        $this->builderContentMock->expects($this->once())
            ->method('getType')
            ->willReturn($type);

        $this->builderContentMock->expects($this->any())
            ->method('getPropertyValue')
            ->willReturn($propertyValue);

        // Act
        $actual = $this->expander->isApplicable($this->builderContentMock);

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
