<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Filesystem;

use Generator;

interface DefinitionFinderInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\DefinitionTransferException
     *
     * @return Generator<string>
     */
    public function getDefinitionContent(): Generator;
}
