<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator\Builder;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface TransferGeneratorBuilderInterface
{
    public function createErrorWithDefinitionGeneratorTransfer(
        string $errorMessage,
        DefinitionTransfer $definitionTransfer,
    ): TransferGeneratorTransfer;

    public function createErrorGeneratorTransfer(string $errorMessage): TransferGeneratorTransfer;

    public function createSuccessGeneratorTransfer(): TransferGeneratorTransfer;

    public function createGeneratorTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer;
}
