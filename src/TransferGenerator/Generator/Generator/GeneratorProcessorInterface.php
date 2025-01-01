<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\DefinitionTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface GeneratorProcessorInterface
{
    public function preProcess(): TransferGeneratorTransfer;

    public function postProcessSuccess(): TransferGeneratorTransfer;

    public function postProcessError(): TransferGeneratorTransfer;

    public function process(DefinitionTransfer $definitionTransfer): TransferGeneratorTransfer;
}
