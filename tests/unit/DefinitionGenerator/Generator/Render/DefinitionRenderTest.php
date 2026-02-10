<?php

declare(strict_types=1);

namespace DefinitionGenerator\Generator\Render;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\TestDoxFormatter;
use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;
use Picamator\TransferObject\DefinitionGenerator\Generator\Render\TemplateRender;
use Picamator\TransferObject\DefinitionGenerator\Generator\Render\TemplateRenderInterface;
use Picamator\TransferObject\Generated\DefinitionBuiltInTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

#[Group('definition-generator')]
final class DefinitionRenderTest extends TestCase
{
    private const string TEST_CLASS_NAME = 'TestClass';

    private TemplateRenderInterface $render;

    protected function setUp(): void
    {
        $this->render = new TemplateRender();
    }

    /**
     * @param array<string,string> $propertyData
     */
    #[DataProvider('successfulRenderDataProvider')]
    #[TestDoxFormatter('successfulRenderTestDoxFormatter')]
    public function testSuccessfulRenderShouldReturnExpectedContent(array $propertyData, string $expected): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = self::TEST_CLASS_NAME;
        $contentTransfer->properties[] = new DefinitionPropertyTransfer()->fromArray($propertyData);

        // Act
        $actual = $this->render->renderContent($contentTransfer);

        // Assert
        $this->assertSame($expected, $actual);
    }

    /**
     * @param array<string,string> $propertyData
     */
    public static function successfulRenderTestDoxFormatter(array $propertyData, string $expected): string
    {
        return sprintf(
            "Render property data \"%s\" should expect \n \"%s\"",
            json_encode($propertyData),
            $expected,
        );
    }

    public static function successfulRenderDataProvider(): Generator
    {
        yield 'transfer object with built-in property type' => [
            'propertyData' => [
                DefinitionPropertyTransfer::PROPERTY_NAME_PROP => 'testProperty',
                DefinitionPropertyTransfer::BUILT_IN_TYPE_PROP => [
                    DefinitionBuiltInTypeTransfer::NAME_PROP => 'string',
                ],
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
                DefinitionPropertyTransfer::PROPERTY_NAME_PROP => 'testProperty',
                DefinitionPropertyTransfer::TRANSFER_TYPE_PROP => [
                    DefinitionEmbeddedTypeTransfer::NAME_PROP => 'TestItem',
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
                DefinitionPropertyTransfer::PROPERTY_NAME_PROP => 'testProperty',
                DefinitionPropertyTransfer::COLLECTION_TYPE_PROP => [
                    DefinitionEmbeddedTypeTransfer::NAME_PROP => 'TestItem',
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

    #[TestDox('Property type is not set should throw exception')]
    public function testPropertyTypeIsNotSetShouldThrowException(): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = self::TEST_CLASS_NAME;

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = '';
        $propertyTransfer->isRequired = false;
        $propertyTransfer->isProtected = false;

        $contentTransfer->properties[] = $propertyTransfer;

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->render->renderContent($contentTransfer);
    }
}
