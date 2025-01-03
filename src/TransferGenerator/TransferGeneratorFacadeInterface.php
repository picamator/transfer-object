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
     * - Fiber suspends after configuration load
     * - Fiber suspends after generating Transfer Object returning back `TransferGeneratorTransfer`
     * - Transfer Object `TransferGeneratorTransfer` might contain error messages
     * - Returns `true` when process is successful, `false` otherwise
     *
     * @throws \FiberError
     * @throws \Throwable
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     *
     * @return \Fiber<string,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;

    /**
     * Specification:
     * - Loads configuration
     * - Generates Transfer Objects
     * - Throws exception on errors
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateTransfersOrFail(string $configPath): void;
}
