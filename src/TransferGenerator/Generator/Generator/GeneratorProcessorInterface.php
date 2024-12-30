<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface GeneratorProcessorInterface
{
    public function preGenerateTransfer(): void;

    public function postGenerateTransfer(bool $isSuccess): void;

    public function generateTransfer(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer;
}
