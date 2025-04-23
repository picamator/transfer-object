<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Generates transfer object definition files based on the provided content data.
     * - Saves the generated definitions as YAML files.
     * - Returns the number of successfully generated definitions.
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     *@example ./doc/samples/try-definition-generator.php
     *
     * @api
     *
     */
    public function generateDefinitions(DefinitionGeneratorTransfer $generatorTransfer): int;
}
