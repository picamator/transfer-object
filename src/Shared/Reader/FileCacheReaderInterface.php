<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Reader;

use ArrayObject;

interface FileCacheReaderInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileCacheReaderException
     *
     * @return \ArrayObject<string, string>
     */
    public function readFile(string $path): ArrayObject;
}
