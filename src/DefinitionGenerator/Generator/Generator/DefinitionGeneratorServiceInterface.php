<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorServiceInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     */
    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int;
}
