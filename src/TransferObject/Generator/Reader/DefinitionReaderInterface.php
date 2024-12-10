<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Reader;

use Generator;
use Picamator\TransferObject\Generated\DefinitionPathTransfer;

interface DefinitionReaderInterface
{
    /**
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    public function getDefinitions(): Generator;

    public function countDefinitions(): int;
}
