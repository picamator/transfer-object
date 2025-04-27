<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Render;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRender;
use Picamator\TransferObject\DefinitionGenerator\Render\DefinitionRenderInterface;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

class DefinitionRenderTest extends TestCase
{
    private const string TEST_CLASS_NAME = 'TestClass';

    private DefinitionRenderInterface $render;

    protected function setUp(): void
    {
        $this->render = new DefinitionRender();
    }

    /**
     * @param array<string,string> $propertyData
     */
    #[DataProvider('successfulRenderDataProvider')]
    public function testSuccessfulRenderShouldReturnExpectedContent(array $propertyData, string $expected): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = self::TEST_CLASS_NAME;
        $contentTransfer->properties[] = new DefinitionPropertyTransfer()->fromArray($propertyData);

        // Act
        $actual = $this->render->renderDefinitionContent($contentTransfer);

        // Assert
        $this->assertSame($expected, $actual);
    }

    public static function successfulRenderDataProvider(): Generator
    {
        yield 'transfer object with build in property type' => [
            'propertyData' => [
                DefinitionPropertyTransfer::PROPERTY_NAME => 'testProperty',
                DefinitionPropertyTransfer::BUILD_IN_TYPE => 'string',
            ],
            'expected' => <<<'DEFINITION'
# TestClass
TestClass:
  testProperty:
    type: string


DEFINITION,
        ];

        yield 'transfer object with transfer property type' => [
            'propertyData' => [
                DefinitionPropertyTransfer::PROPERTY_NAME => 'testProperty',
                DefinitionPropertyTransfer::TRANSFER_TYPE => [
                    DefinitionEmbeddedTypeTransfer::NAME => 'TestItem',
                ],
            ],
            'expected' => <<<'DEFINITION'
# TestClass
TestClass:
  testProperty:
    type: TestItem


DEFINITION,
        ];

        yield 'transfer object with collection property type' => [
            'propertyData' => [
                DefinitionPropertyTransfer::PROPERTY_NAME => 'testProperty',
                DefinitionPropertyTransfer::COLLECTION_TYPE => [
                    DefinitionEmbeddedTypeTransfer::NAME => 'TestItem',
                ],
            ],
            'expected' => <<<'DEFINITION'
# TestClass
TestClass:
  testProperty:
    collectionType: TestItem


DEFINITION,
        ];
    }

    public function testPropertyTypeIsNotSetShouldRiseException(): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = self::TEST_CLASS_NAME;

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = '';
        $propertyTransfer->isNullable = true;
        $propertyTransfer->isProtected = false;

        $contentTransfer->properties[] = $propertyTransfer;

        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->render->renderDefinitionContent($contentTransfer);
    }
}
