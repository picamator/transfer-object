<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

use Generator;

interface FileReaderProgressInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileReaderException
     *
     * @return \Generator<int,\Picamator\TransferObject\Generated\FileReaderProgressTransfer>
     */
    public function readFile(string $filename): Generator;
}
