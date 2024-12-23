<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Builder;

use Generator;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

interface DefinitionBuilderInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     *
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionContentTransfer>
     */
    public function buildDefinitionContents(DefinitionGeneratorContentTransfer $generatorContentTransfer): Generator;
}
