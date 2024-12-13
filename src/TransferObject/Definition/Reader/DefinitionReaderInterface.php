<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Reader;

use Generator;

interface DefinitionReaderInterface
{
    /**
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    public function getDefinitions(): Generator;
}
