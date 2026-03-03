<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Locker;

use Picamator\TransferObject\Shared\Exception\FileLockerException;

class FileLocker implements FileLockerInterface
{
    /**
     * @var null|resource
     */
    private $lockFile = null;

    public function acquireLock(string $filename): void
    {
        $lockFile = $this->fopen($filename);
        if ($lockFile === false) {
            throw new FileLockerException(
                sprintf('Failed to open file "%s".', $filename),
            );
        }

        if ($this->flock($lockFile, LOCK_EX) === false) {
            $this->fclose($lockFile);

            throw new FileLockerException(
                sprintf('Failed to acquire lock for file "%s".', $filename),
            );
        }

        $this->lockFile = $lockFile;
    }

    public function releaseLock(): void
    {
        if (!is_resource($this->lockFile)) {
            return;
        }

        $this->flock($this->lockFile, LOCK_UN);
        $this->fclose($this->lockFile);

        $this->lockFile = null;
    }

    /**
     * @param resource $lockFile
     */
    protected function fclose($lockFile): bool
    {
        return fclose($lockFile);
    }

    /**
     * @param resource $lockFile
     * @param int<0, 7> $operation
     */
    protected function flock($lockFile, int $operation): bool
    {
        return flock($lockFile, $operation);
    }

    /**
     * @return false|resource
     */
    protected function fopen(string $filename)
    {
        return fopen($filename, 'c');
    }
}
