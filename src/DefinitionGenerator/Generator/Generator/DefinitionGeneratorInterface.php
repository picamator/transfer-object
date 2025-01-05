<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function generateDefinitions(DefinitionGeneratorTransfer $generatorTransfer): int;
}
