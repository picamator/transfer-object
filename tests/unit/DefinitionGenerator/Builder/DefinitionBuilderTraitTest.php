<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder;

use PHPUnit\Framework\TestCase;
use Picamator\TransferObject\DefinitionGenerator\Builder\DefinitionBuilderTrait;
use Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException;

class DefinitionBuilderTraitTest extends TestCase
{
    private DefinitionBuilderTraitInterface $builderTrait;

    protected function setUp(): void
    {
        $this->builderTrait = new class () implements DefinitionBuilderTraitInterface
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
        $this->builderTrait->createBuilderContent($propertyName, $propertyValue);
    }
}
