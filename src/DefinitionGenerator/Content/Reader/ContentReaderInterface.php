<?php

declare(strict_types=1);

namespace Picamator\TransferObject\DefinitionGenerator\Content\Reader;

use Generator;
use Picamator\TransferObject\Generated\DefinitionGeneratorContentTransfer;

interface ContentReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\DefinitionGenerator\Exception\DefinitionGeneratorException
     *
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionContentTransfer>
     */
    public function getDefinitionContents(DefinitionGeneratorContentTransfer $generatorContentTransfer): Generator;
}
