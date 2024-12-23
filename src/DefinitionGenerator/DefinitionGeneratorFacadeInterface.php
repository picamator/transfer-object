<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Generates definitions by content data
     * - Saves definitions on the file
     * - Returns generated definitions number
     *
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     */
    public function generateDefinitions(DefinitionGeneratorTransfer $generatorTransfer): int;
}
