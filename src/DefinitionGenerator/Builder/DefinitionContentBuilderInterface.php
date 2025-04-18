<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

interface DefinitionContentBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function createBuilderContent(string $propertyName, mixed $propertyValue): BuilderContentInterface;
}
