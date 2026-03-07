<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Dependency\Finder;

use Countable;
use IteratorAggregate;
use Picamator\TransferObject\Dependency\Exception\FinderException;
use Symfony\Component\Finder\Finder;
use Throwable;

final readonly class FinderBridge implements FinderInterface
{
    public function findFilesInDirectory(
        string $filePattern,
        string $dirName,
        ?string $maxFileSize = null,
    ): IteratorAggregate&Countable {
        try {
            $finder = Finder::create()
                ->files()
                ->name($filePattern)
                ->depth(0)
                ->in($dirName);

            if ($maxFileSize !== null) {
                $finder->size('<= ' . $maxFileSize);
            }

            return $this->getFinderBridge($finder);
            // @codeCoverageIgnoreStart
        } catch (Throwable $e) {
            throw new FinderException(
                sprintf(
                    'Failed to find files "%s" in directory "%s". Error: "%s".',
                    $filePattern,
                    $dirName,
                    $e->getMessage(),
                ),
                previous: $e,
            );
        }
        // @codeCoverageIgnoreEnd
    }

    /**
     * @return Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    private function getFinderBridge(Finder $finder): IteratorAggregate&Countable
    {
        return new FinderIterator($finder);
    }
}
