<?php declare(strict_types=1);

namespace Picamator\TransferObject\Definition;

use Generator;

class DefinitionFacade implements DefinitionFacadeInterface
{
    public function getDefinitions(): Generator
    {
        return new DefinitionFactory()
            ->createDefinitionReader()
            ->getDefinitions();
    }
}