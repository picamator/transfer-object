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
use Picamator\TransferObject\Generated\DefinitionBuildInTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionContentTransfer;
use Picamator\TransferObject\Generated\DefinitionEmbeddedTypeTransfer;
use Picamator\TransferObject\Generated\DefinitionPropertyTransfer;

#[Group('definition-generator')]
class DefinitionRenderTest extends TestCase
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
        yield 'transfer object with build in property type' => [
            'propertyData' => [
                DefinitionPropertyTransfer::PROPERTY_NAME => 'testProperty',
                DefinitionPropertyTransfer::BUILD_IN_TYPE => [
                    DefinitionBuildInTypeTransfer::NAME => 'string',
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

    #[TestDox('Property type is not set should throw exception')]
    public function testPropertyTypeIsNotSetShouldThrowException(): void
    {
        // Arrange
        $contentTransfer = new DefinitionContentTransfer();
        $contentTransfer->className = self::TEST_CLASS_NAME;

        $propertyTransfer = new DefinitionPropertyTransfer();
        $propertyTransfer->propertyName = '';
        $propertyTransfer->isNullable = true;
        $propertyTransfer->isProtected = false;

        $contentTransfer->properties[] = $propertyTransfer;

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->render->renderContent($contentTransfer);
    }
}
