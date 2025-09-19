<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Unit\TransferObject\Helper\FileStreamHelperTrait;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilder;
use Picamator\TransferObject\DefinitionGenerator\Content\Builder\ContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

#[Group('definition-generator')]
class DefinitionContentBuilderTest extends TestCase
{
    use FileStreamHelperTrait;

    private ContentBuilderInterface $builder;

    protected function setUp(): void
    {
        $this->builder = new ContentBuilder();
    }

    protected function tearDown(): void
    {
        $this->closeTempFileStream();
    }

    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $propertyName = 'file';
        $propertyValue = $this->getTempFileStream();

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->createBuilderContent($propertyName, $propertyValue);
    }

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
