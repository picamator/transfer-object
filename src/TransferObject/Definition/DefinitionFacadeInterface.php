<?php declare(strict_types=1);

namespace Picamator\TransferObject\Definition;

use Generator;

interface DefinitionFacadeInterface
{
    /**
     * @return \Generator<\Picamator\TransferObject\Generated\DefinitionTransfer>
     */
    public function getDefinitions(): Generator;
}
