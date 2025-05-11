<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Builder;

use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileLocalException
     */
    public function setDefinitionPath(string $definitionPath): self;

    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function setClassName(string $className): self;

    /**
     * @throws \Picamator\TransferObject\Shared\Exception\JsonReaderException
     */
    public function setJsonPath(string $jsonPath): self;

    public function build(): DefinitionGeneratorTransfer;
}
