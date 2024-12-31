<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;

interface DefinitionFinderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException
     *
     * @return Generator<string,string>
     */
    public function getDefinitionFiles(): Generator;
}
