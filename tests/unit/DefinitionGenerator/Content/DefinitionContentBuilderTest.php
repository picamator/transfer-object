<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Content;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Unit\TransferObject\Helper\FileTrait;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilder;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

#[Group('definition-generator')]
final class DefinitionContentBuilderTest extends TestCase
{
    use FileTrait;

    private ContentBuilderInterface $builder;

    protected function setUp(): void
    {
        $this->builder = new ContentBuilder();
    }

    public static function tearDownAfterClass(): void
    {
        self::closeFile();
    }

    #[TestDox('Unsupported type should throw exception')]
    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $propertyName = 'file';
        $propertyValue = self::openFile();

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->createBuilderContent($propertyName, $propertyValue);
    }

    #[TestDox('Invalid property name should throw exception')]
    public function testInvalidPropertyNameShouldThrowException(): void
    {
        // Arrange
        $propertyName = 'file.txt';
        $propertyValue = 'something';

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->createBuilderContent($propertyName, $propertyValue);
    }
}
