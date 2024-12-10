<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Reader;

use Picamator\TransferObject\Generated\DefinitionTransfer;

interface DefinitionReaderBuilderInterface
{
    public function createDefinitionTransfer(array $definition): DefinitionTransfer;
}
