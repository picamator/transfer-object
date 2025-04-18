<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\TemplateHelper;

class TemplateHelperTest extends TestCase
{
    /**
     * @param array<string,mixed> $templateData
     */
    #[DataProvider('getNullableDataProvider')]
    public function testGetNullable(array $templateData, string $property, string $expected): void
    {
        // Arrange
        $templateTransfer = new TemplateTransfer()->fromArray($templateData);
        $templateHelper = new TemplateHelper()->setTemplateTransfer($templateTransfer);

        // Act
        $actual = $templateHelper->getNullable($property);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function getNullableDataProvider(): Generator
    {
        yield 'property is not nullable should return empty string' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES => [
                    'test' => 'TestTransfer',
                ],
                TemplateTransfer::NULLABLES => [
                    'test' => false,
                ],
            ],
            'property' => 'test',
            'expected' => '',
        ];

        yield 'property is nullable but with intersection type should return empty string' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES => [
                    'test' => 'TestTransfer&TTransferInterface',
                ],
                TemplateTransfer::NULLABLES => [
                    'test' => true,
                ],
            ],
            'property' => 'test',
            'expected' => '',
        ];

        yield 'property is nullable with union should return union null' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES => [
                    'test' => 'TestTransfer|TransferInterface',
                ],
                TemplateTransfer::NULLABLES => [
                    'test' => true,
                ],
            ],
            'property' => 'test',
            'expected' => 'null|',
        ];

        yield 'property is nullable without intersection or union should return null type' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES => [
                    'test' => 'TestTransfer',
                ],
                TemplateTransfer::NULLABLES => [
                    'test' => true,
                ],
            ],
            'property' => 'test',
            'expected' => '?',
        ];
    }
}
