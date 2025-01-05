<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Generates definitions by content data
     * - Saves definitions as yml file
     * - Returns number of generated definitions
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateDefinitions(DefinitionGeneratorTransfer $generatorTransfer): int;
}
