<?php declare(strict_types = 1);

namespace Picamator\TransferObject\Generator\Filesystem;

use Generator;

interface DefinitionFilesystemInterface
{
    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     *
     * @return Generator<string>
     */
    public function getDefinitionContent(): Generator;

    /**
     * @throws \Picamator\TransferObject\Exception\GeneratorTransferException
     */
    public function countDefinitions(): int;
}
