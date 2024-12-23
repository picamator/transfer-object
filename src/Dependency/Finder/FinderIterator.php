<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Finder;

use Iterator;
use OuterIterator;
use Symfony\Component\Finder\Finder;

/**
 * @implements \OuterIterator<string,\Picamator\TransferObject\Dependency\Finder\SplFileInfoBridge>
 */
final readonly class FinderIterator implements OuterIterator
{
    public function __construct(private Finder $finder)
    {
    }

    public function current(): mixed
    {
        /** @var \Symfony\Component\Finder\SplFileInfo $current */
        $current = $this->finder->getIterator()->current();

        return new SplFileInfoBridge($current);
    }

    public function next(): void
    {
        $this->finder->getIterator()->next();
    }

    public function key(): mixed
    {
        return $this->finder->getIterator()->key();
    }

    public function valid(): bool
    {
        return $this->finder->getIterator()->valid();
    }

    public function rewind(): void
    {
        $this->finder->getIterator()->rewind();
    }

    public function getInnerIterator(): Iterator
    {
        foreach($this->finder->getIterator() as $key => $splFileInfo) {
            yield $key => new SplFileInfoBridge($splFileInfo);
        };
    }
}
