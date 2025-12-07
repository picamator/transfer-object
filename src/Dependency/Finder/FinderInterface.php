<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Finder;

use Countable;
use IteratorAggregate;

interface FinderInterface
{
    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     *
     * @return Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    public function findFilesInDirectory(
        string $filePattern,
        string $dirName,
        ?string $maxFileSize = null,
    ): IteratorAggregate&Countable;

    /**
     * @throws \Picamator\TransferObject\Dependency\Exception\FinderException
     *
     * @return Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    public function findFilesInDirectoryExclude(
        string $filePattern,
        string $dirName,
        string $exclude,
    ): IteratorAggregate&Countable;
}
