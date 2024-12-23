<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;

interface DefinitionFinderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     *
     * @return Generator<string>
     */
    public function getDefinitionContent(): Generator;
}
