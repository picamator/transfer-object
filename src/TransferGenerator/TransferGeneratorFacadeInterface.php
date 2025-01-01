<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface TransferGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Provides Transfer Generator Fiber
     * - Starts fiber with `$configPath`
     * - First fiber suspend after configuration load
     * - Next fiber suspends after generating Transfer Object passing `TransferGeneratorTransfer` back
     * - Throw fiber exception terminates process and return `false`
     * - Transfer object `TransferGeneratorTransfer` might contain error messages if any occur
     * - Returns `true` when whole process is successful, `false` otherwise
     *
     * @throws \FiberError
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     *
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;

    /**
     * Specification:
     * - Loads configuration
     * - Generates Transfer Objects
     * - Throws exception on error
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateTransfers(string $configPath): void;
}
