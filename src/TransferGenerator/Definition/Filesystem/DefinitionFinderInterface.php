<?php declare(strict_types = 1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;

interface DefinitionFinderInterface
{
    /**
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\DefinitionTransferException
     *
     * @return Generator<string>
     */
    public function getDefinitionContent(): Generator;
}
