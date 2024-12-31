<?php

declare(strict_types=1);

namespace Picamator\TransferObject\TransferGenerator;

use Fiber;
use Generator;
use Picamator\TransferObject\Generated\ConfigTransfer;
use Picamator\TransferObject\Generated\TransferGeneratorTransfer;

interface TransferGeneratorFacadeInterface
{
    /**
     * Specification:
     * - Requires config loading `self::loadConfig()`
     * - Generates new Transfer Object on each iteration
     * - Transfer object `TransferGeneratorTransfer` might contain error messages if any occur
     * - Returns `true` when whole process is successful, `false` otherwise
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     *
     * @return \Generator<int,\Picamator\TransferObject\Generated\TransferGeneratorTransfer>
     */
    public function getTransferGenerator(): Generator;

    /**
     * Specification:
     * - Requires config loading `self::loadConfig()`
     * - Provides Transfer Generator Fiber
     * - Suspends after generating Transfer Object passing `TransferGeneratorTransfer` back
     * - Transfer object `TransferGeneratorTransfer` might contain error messages if any occur
     * - Returns `true` when whole process is successful, `false` otherwise
     *
     * @throws \FiberError
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     *
     * @return \Fiber<null,null,bool,TransferGeneratorTransfer>
     */
    public function getTransferGeneratorFiber(): Fiber;

    /**
     * Specification:
     * - Requires config loading `self::loadConfig()`
     * - Generates Transfer Objects without output
     * - Throws exception on any error
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function generateTransfers(): void;

    /**
     * Specification:
     * - Reads and parses provided configuration file
     * - Statically loads configuration to reuse for transfer object generation
     *
     * @throws \Picamator\TransferObject\Exception\TransferExceptionInterface
     */
    public function loadConfig(string $configPath): ConfigTransfer;
}
