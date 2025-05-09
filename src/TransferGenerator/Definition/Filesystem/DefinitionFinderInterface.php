<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;

interface DefinitionFinderInterface
{
    /**
     * @return Generator<string,string>
     *@throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorConfigNotFoundException
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     */
    public function getDefinitionFiles(): Generator;
}
