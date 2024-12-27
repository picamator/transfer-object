<?php

declare(strict_types=1);

namespace Picamator\Tests\Unit\TransferObject\DefinitionGenerator\Builder;

use Picamator\TransferObject\DefinitionGenerator\Builder\BuilderContentInterface;

interface DefinitionBuilderTraitInterface
{
    public function createBuilderContent(string $propertyName, mixed $propertyValue): BuilderContentInterface;
}
