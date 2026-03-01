<?php

declare(strict_types=1);

namespace Picamator\Tests\Integration\TransferObject\Helper;

/**
 * @phpstan-require-extends \PHPUnit\Framework\TestCase
 */
trait FileTrait
{
    /**
     * @param array<int, string> $paths
     */
    final protected function assertFilesExist(array $paths): void
    {
        foreach ($paths as $file) {
            $this->assertFileExists($file);
        }
    }

    /**
     * @param array<int, string> $paths
     *
     * @return array<string, int>
     */
    final protected function getModifiedTimes(array $paths): array
    {
        $modificationTimes = [];
        foreach ($paths as $path) {
            $modificationTime = filemtime($path);

            $this->assertNotFalse(
                $modificationTime,
                sprintf('Failed to get file "%s" modified date.', $path),
            );

            $modificationTimes[$path] = $modificationTime;
        }

        return $modificationTimes;
    }

    /**
     * @param array<string, int> $modifiedTimesBefore
     * @param array<string, int> $modifiedTimesAfter
     */
    final protected function assertNotSameModifiedTimes(array $modifiedTimesBefore, array $modifiedTimesAfter): void
    {
        $this->assertSameSize(
            $modifiedTimesBefore,
            $modifiedTimesAfter,
            'Modified times should be the same size.',
        );

        foreach ($modifiedTimesBefore as $path => $modifiedTimeBefore) {
            $this->assertNotSame(
                $modifiedTimeBefore,
                $modifiedTimesAfter[$path],
                sprintf('Modified file time "%s" should be different.', $path),
            );
        }
    }
}
