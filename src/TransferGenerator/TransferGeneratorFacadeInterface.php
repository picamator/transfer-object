<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

interface TransferGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Generates Transfer Objects using Fibers
     * - Fiber First Suspend on creating temporary directory
     * - Fiber Next Suspend after generating one Transfer Object passing `TransferGeneratorCallbackTransfer` into callback
     * - Returns `true` when whole process is successful, `false` otherwise
     *
     * @throws \Picamator\TransferObject\Dependency\Exception\FilesystemException
     * @throws \Picamator\TransferObject\TransferGenerator\Exception\TransferGeneratorException
     */
    public function generateTransfers(callable $handleCallback): bool;
}
