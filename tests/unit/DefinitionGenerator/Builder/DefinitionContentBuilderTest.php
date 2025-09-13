<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Picamator\Tests\Unit\TransferObject\Helper\FileStreamHelperTrait;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionContentBuilder;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

#[Group('definition-generator')]
class DefinitionContentBuilderTest extends TestCase
{
    use FileStreamHelperTrait;

    private DefinitionContentBuilderInterface $builder;

    protected function setUp(): void
    {
        $this->builder = new DefinitionContentBuilder();
    }

    protected function tearDown(): void
    {
        $this->closeTempFileStream();
    }

    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $propertyName = 'file.txt';
        $propertyValue = $this->getTempFileStream();

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->createBuilderContent($propertyName, $propertyValue);
    }
}
