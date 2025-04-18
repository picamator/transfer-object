<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Definition\Filesystem;

use Generator;

interface DefinitionFinderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorDefinitionException
     * @throws \Picamator\TransferObject\TransferGenerator\Config\Exception\ConfigNotFoundException
     *
     * @return Generator<string,string>
     */
    public function getDefinitionFiles(): Generator;
}
