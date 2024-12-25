<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Finder;

use IteratorAggregate;
use Countable;
use Symfony\Component\Finder\Finder;
use Traversable;

/**
 * @implements \IteratorAggregate<string,\Picamator\TransferObject\Dependency\Finder\SplFileInfoBridge>
 */
final readonly class FinderIterator implements IteratorAggregate, Countable
{
    public function __construct(private Finder $finder)
    {
    }

    public function getIterator(): Traversable
    {
        foreach ($this->finder->getIterator() as $key => $splFileInfo) {
            yield $key => new SplFileInfoBridge($splFileInfo);
        }
    }

    public function count(): int
    {
        return $this->finder->count();
    }
}
