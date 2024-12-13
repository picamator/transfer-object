<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Definition\Filesystem;

use Generator;

interface DefinitionFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     *
     * @return Generator<string>
     */
    public function getDefinitionContent(): Generator;
}
