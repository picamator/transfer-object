<?php

declare(strict_types=1);

namespace Picamator\TransferObject\Shared\Locker;

interface FileLockerInterface
{
    /**
     * @throws \Picamator\TransferObject\Shared\Exception\FileLockerException
     */
    public function acquireLock(string $filename): void;

    public function releaseLock(): void;
}
