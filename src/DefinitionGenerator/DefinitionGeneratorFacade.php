<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator;

use Picamator\TransferObject\DefinitionGenerator\Generator\DefinitionGeneratorFactory;
use Picamator\TransferObject\Generated\HelperTransfer;

readonly class DefinitionGeneratorFacade implements DefinitionGeneratorFacadeInterface
{
    public function generateDefinitions(HelperTransfer $helperTransfer): int
    {
        return new DefinitionGeneratorFactory()
            ->createDefinitionGenerator()
            ->generateDefinitions($helperTransfer);
    }
}
