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
            $modificationTimes[$path] = $this->getModifiedTime($path);
        }

        return $modificationTimes;
    }

    final protected function getModifiedTime(string $path): int
    {
        $modificationTime = filemtime($path);

        $this->assertNotFalse(
            $modificationTime,
            sprintf('Failed to get file "%s" modified date.', $path),
        );

        return $modificationTime;
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
            $this->assertArrayHasKey(
                $path,
                $modifiedTimesAfter,
                sprintf('Modified Time Before "%s" should exist.', $path),
            );

            $this->assertNotSameModifiedTime($modifiedTimeBefore, $modifiedTimesAfter[$path]);
        }
    }

    final protected function assertNotSameModifiedTime(int $modifiedTimeBefore, int $modifiedTimeAfter): void
    {
        $this->assertNotSame(
            $modifiedTimeBefore,
            $modifiedTimeAfter,
            'Modified file time should be different.',
        );
    }

    final protected function saveFileContent(string $path, string $content): void
    {
        $result = file_put_contents($path, $content);
        $this->assertNotFalse($result, sprintf('Failed to save content to "%s".', $path));
    }

    final protected function createEmptyFile(string $path): void
    {
        $result = touch($path);
        $this->assertNotFalse($result, sprintf('Failed to create file "%s".', $path));
    }
}
