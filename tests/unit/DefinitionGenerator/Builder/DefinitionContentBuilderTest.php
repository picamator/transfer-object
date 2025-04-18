<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionContentBuilder;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionContentBuilderInterface;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

class DefinitionContentBuilderTest extends TestCase
{
    private DefinitionContentBuilderInterface $builder;

    protected function setUp(): void
    {
        $this->builder = new DefinitionContentBuilder();
    }

    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $propertyName = 'file';
        $propertyValue = tmpfile();

        // Expect
        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->createBuilderContent($propertyName, $propertyValue);
    }
}
