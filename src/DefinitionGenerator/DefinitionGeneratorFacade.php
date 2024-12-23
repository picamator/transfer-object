<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\DefinitionGenerator\Generator\DefinitionGeneratorFactory;
use Picamator\TransferObject\Generated\DefinitionGeneratorTransfer;

readonly class DefinitionGeneratorFacade implements DefinitionGeneratorFacadeInterface
{
    public function generateDefinitions(DefinitionGeneratorTransfer $generatorTransfer): int
    {
        return new DefinitionGeneratorFactory()
            ->createDefinitionGenerator()
            ->generateDefinitions($generatorTransfer);
    }
}
