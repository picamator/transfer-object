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
    public function findFilesInDirectory(string $filePattern, string $dirName): IteratorAggregate&Countable
    {
        try {
            $finder = Finder::create()
                ->files()
                ->name($filePattern)
                ->in($dirName);

            return $this->getFinderBridge($finder);
        } catch (Throwable $e) {
            throw new FinderException(
                sprintf(
                    'Fail to find files "%s" in directory "%s".',
                    $filePattern,
                    $dirName,
                ),
                previous: $e,
            );
        }
    }

    public function findFilesInDirectoryExclude(
        string $filePattern,
        string $dirName,
        string $exclude,
    ): IteratorAggregate&Countable {
        try {
            $finder = Finder::create()
                ->files()
                ->name($filePattern)
                ->in($dirName)
                ->exclude($exclude);

            return $this->getFinderBridge($finder);
        } catch (Throwable $e) {
            throw new FinderException(
                sprintf(
                    'Fail to find files "%s" in directory "%s" excluding "%s".',
                    $filePattern,
                    $dirName,
                    $exclude,
                ),
                previous: $e,
            );
        }
    }

    /**
     * @return Countable&IteratorAggregate<string,SplFileInfoBridge>
     */
    private function getFinderBridge(Finder $finder): IteratorAggregate&Countable
    {
        return new FinderIterator($finder);
    }
}
