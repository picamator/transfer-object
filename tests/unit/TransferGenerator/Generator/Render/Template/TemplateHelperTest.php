<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\TransferGenerator\Generator\Render\Template;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\Generated\TemplateTransfer;
use Picamator\TransferObject\TransferGenerator\Generator\Render\Template\Helper\TemplateHelper;

#[Group('transfer-generator')]
class TemplateHelperTest extends TestCase
{
    /**
     * @param array<string,mixed> $templateData
     */
    #[DataProvider('getRequiredDataProvider')]
    #[TestDoxFormatter('getRequiredTestDoxFormatter')]
    public function testGetRequired(array $templateData, string $property, string $expected): void
    {
        // Arrange
        $templateTransfer = new TemplateTransfer()->fromArray($templateData);
        $templateHelper = new TemplateHelper()->setTemplateTransfer($templateTransfer);

        // Act
        $actual = $templateHelper->renderRequired($property);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @param array<string,mixed> $templateData
     */
    public static function getRequiredTestDoxFormatter(array $templateData, string $property, string $expected): string
    {
        return sprintf(
            'Template data "%s" expect property "%s" required rendered as "%s"',
            json_encode($templateData),
            $property,
            $expected,
        );
    }

    /**
     * @return Generator<string,mixed>
     */
    public static function getRequiredDataProvider(): Generator
    {
        yield 'property is required should return empty string' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES_PROP => [
                    'test' => 'TestTransfer',
                ],
                TemplateTransfer::REQUIRES_PROP => [
                    'test' => true,
                ],
            ],
            'property' => 'test',
            'expected' => '',
        ];

        yield 'property is nullable but with an intersection type should return an empty string' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES_PROP => [
                    'test' => 'TestTransfer&TTransferInterface',
                ],
                TemplateTransfer::REQUIRES_PROP => [
                    'test' => false,
                ],
            ],
            'property' => 'test',
            'expected' => '',
        ];

        yield 'property is nullable with union should return union null' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES_PROP => [
                    'test' => 'TestTransfer|TransferInterface',
                ],
                TemplateTransfer::REQUIRES_PROP => [
                    'test' => false,
                ],
            ],
            'property' => 'test',
            'expected' => 'null|',
        ];

        yield 'property is nullable without intersection or union should return the null type' => [
            'templateData' => [
                TemplateTransfer::PROPERTIES_PROP => [
                    'test' => 'TestTransfer',
                ],
                TemplateTransfer::REQUIRES_PROP => [
                    'test' => false,
                ],
            ],
            'property' => 'test',
            'expected' => '?',
        ];
    }
}
