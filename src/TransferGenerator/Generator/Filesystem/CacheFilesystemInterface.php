<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator\Generator\Filesystem;

use ArrayObject;

interface CacheFilesystemInterface
{
    /**
     * @return \ArrayObject<string, string>
     */
    public function readFromCache(): ArrayObject;

    /**
     * @return \ArrayObject<string, string>
     */
    public function readFromTempCache(): ArrayObject;

    public function appendToTempCache(string $className, string $hash): void;

    public function closeTempCache(): void;
}
