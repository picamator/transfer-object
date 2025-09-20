<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Builder;

interface ContentBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function createBuilderContent(string $propertyName, mixed $propertyValue): ContentInterface;
}
