<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render\Template;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\TemplateHelper;

#[Group('transfer-generator')]
class TemplateHelperTest extends TestCase
{
    /**
     * @param array<string,mixed> $templateData
     */
    #[DataProvider('getNullableDataProvider')]
    #[TestDoxFormatter('getNullableTestDoxFormatter')]
    public function testGetNullable(array $templateData, string $property, string $expected): void
    {
        // Arrange
        $templateTransfer = new TemplateTransfer()->fromArray($templateData);
        $templateHelper = new TemplateHelper()->setTemplateTransfer($templateTransfer);

        // Act
        $actual = $templateHelper->renderNullable($property);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @param array<string,mixed> $templateData
     */
    public static function getNullableTestDoxFormatter(array $templateData, string $property, string $expected): string
    {
        return sprintf(
            'Template data "%s" expect property "%s" nullable rendered as "%s"',
            json_encode($templateData),
            $property,
            $expected,
        );
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
