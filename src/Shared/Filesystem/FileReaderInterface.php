<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Filesystem;

use Generator;

interface FileReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     *
     * @return \Generator<int,string>
     */
    public function readFile(string $filename): Generator;
}
