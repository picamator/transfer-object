<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\DefinitionGenerator\Generator\Builder\DefinitionGeneratorBuilderInterface;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

interface DefinitionGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Generates transfer object definition files based on the provided content data.
     * - Saves the generated definitions as YAML files.
     * - Returns the number of successfully generated definitions.
     *
     * @api
     *
     * @example ./doc/samples/try-definition-generator.php
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     */
    public function generateDefinitionsOrFail(DefinitionGeneratorTransfer $generatorTransfer): int;

    /**
     * Specification:
     * - Creates a flow interface to build definition generator transfer.
     *
     * @throws \Picamator\TransferObject\Shared\Exception\TransferExceptionInterface
     *
     * @internal
     */
    public function createDefinitionGeneratorBuilder(): DefinitionGeneratorBuilderInterface;
}
