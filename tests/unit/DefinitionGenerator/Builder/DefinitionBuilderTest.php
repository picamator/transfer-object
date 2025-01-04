<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderTrait;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

class DefinitionBuilderTest extends TestCase
{
    private DefinitionBuilderInterface $builder;

    protected function setUp(): void
    {
        $this->builder = new class () implements DefinitionBuilderInterface
        {
            use DefinitionBuilderTrait {
                createBuilderContent as public;
            }
        };
    }

    public function testUnsupportedTypeShouldThrowException(): void
    {
        // Arrange
        $propertyName = 'file';
        $propertyValue = tmpfile();

        $this->expectException(DefinitionGeneratorException::class);

        // Act
        $this->builder->createBuilderContent($propertyName, $propertyValue);
    }
}
