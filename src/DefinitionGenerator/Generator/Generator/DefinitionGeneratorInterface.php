<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Generator\Generator;

use Picamator\TransferObject\Generated\HelperTransfer;

interface DefinitionGeneratorInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\GeneratorTransferException
     */
    public function generateDefinitions(HelperTransfer $helperTransfer): int;
}
