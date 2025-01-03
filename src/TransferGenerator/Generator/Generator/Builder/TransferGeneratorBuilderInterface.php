<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;
use Throwable;

interface TransferGeneratorBuilderInterface
{
    public function createExceptionGeneratorTransfer(
        Throwable $e,
        ?DefinitionTransfer $definitionTransfer = null,
    ): TransferGeneratorTransfer;

    public function createErrorGeneratorTransfer(string $errorMessage): TransferGeneratorTransfer;

    public function createSuccessGeneratorTransfer(): TransferGeneratorTransfer;

    public function createGeneratorTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer;
}
